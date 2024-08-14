<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->em = $entityManagerInterface;
    }

    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Order')
            ->setEntityLabelInPlural('Orders');
    }

    public function configureActions(Actions $actions): Actions
    {
        $show = Action::new('Show')->linkToCrudAction('show');

        return $actions
            ->add(Crud::PAGE_INDEX, $show)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    /*
     * Function to change the order status
     */
    public function changeState($order, $state)
    {
        // 1. Modify the order status
        $order->setState($state);
        $this->em->flush();

        // 2. Display a Flash Message to inform the administrator
        $this->addFlash('success', "Order status successfully updated.");
#still could not use mailjet because of the support said i gotta wait 7 days for my account to work properly and send mails
        /*$mail = new Mail();
        $vars = [
            'firstname' => $order->getUser()->getFirstname(),
            'id_order' => $order->getId()
        ];
        $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname().' '.$order->getUser()->getLastname(), State::STATE[$state]['email_subject'], State::STATE[$state]['email_template'], $vars);*/
    }

    public function show(AdminContext $context, AdminUrlGenerator $adminUrlGenerator, Request $request)
    {
        $order = $context->getEntity()->getInstance();

        // Retrieve the URL of our "SHOW" action
        $url = $adminUrlGenerator->setController(self::class)->setAction('show')->setEntityId($order->getId())->generateUrl();

        // Handle status changes
        if ($request->get('state')) {
            $this->changeState($order,$request->get('state'));
        }

        return $this->render('admin/order.html.twig', [
            'order' => $order,
            'current_url' => $url
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateField::new('createdAt')->setLabel('Date'),
            NumberField::new('state')->setLabel('Status')->setTemplatePath('admin/state.html.twig'),
            AssociationField::new('user')->setLabel('User'),
            TextField::new('carrier')->setLabel('Carrier'),
            NumberField::new('totalTva')->setLabel('Total VAT'),
            NumberField::new('totalWt')->setLabel('Total Incl. Tax'),
        ];
    }
}
