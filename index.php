interface Mediator
{
    public function notify(object $sender, string $event): void;
}


class ConcreteMediator implements Mediator
{
    private $component1;

    private $component2;

    public function __construct(Component1 $c1, Component2 $c2)
    {
        $this->component1 = $c1;
        $this->component1->setMediator($this);
        $this->component2 = $c2;
        $this->component2->setMediator($this);
    }

    public function notify(object $sender, string $event): void
    {
        if ($event == "A") {
                  echo "Mediator actioneaza la A:n";
                 
            $this->component2->doC();
        }

        if ($event == "D") {
                  echo "Mediator actioneaza la D:n";
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}


class BaseComponent
{
    protected $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}


class Component1 extends BaseComponent
{
    public function doA(): void
    {
         echo "Component 1 exe A.n";
        $this->mediator->notify($this, "A");
    }

    public function doB(): void
    {
        echo "Component 1 exe B.n";
        $this->mediator->notify($this, "B");
    }
}

class Component2 extends BaseComponent
{
    public function doC(): void
    {
       echo "Component 2 exe C.n";
        $this->mediator->notify($this, "C");
    }

    public function doD(): void
    {
         echo "Component 2 exe D.n";
        $this->mediator->notify($this, "D");
    }
}


$c1 = new Component1;
$c2 = new Component2;
$mediator = new ConcreteMediator($c1, $c2);

echo "Client exe operation A.n";
$c1->doA();

echo "n";
echo "Client exe operation D.n";
$c2->doD();