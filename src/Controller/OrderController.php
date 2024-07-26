<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Entity\OrderDetail;
use App\Form\OrderType;
use App\Class\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

class OrderController extends AbstractController{
    #[Route('/order/shipping', name: 'app_order')]
    public function index(): Response
    {
        $user=$this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $addresses = $user->getAdresses() ?? [];
        if (count( $addresses)==0){
            return $this->redirectToRoute('app_account_address_form');

        }



        $form = $this->createForm(OrderType::class, null, [
            'addresses' => $addresses,
            'action' => $this->generateUrl('app_order_summary')
        ]);
        return $this->render('order/index.html.twig', [
            'deliveryform' => $form->createView(),
        ]);
    }

    #[Route('/order/summary', name: 'app_order_summary',methods: ['POST',])]
    public function add(Request $request,Cart $cart,EntityManagerInterface $entityManager): Response
    {
        $carts= $cart->getCart();
        if ($request->getMethod() != 'POST') {
            return $this->redirectToRoute('app_cart');
        }

        $form=$this->createForm(OrderType::class,null,[
            'addresses' => $this->getUser()->getAdresses(),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $addressObj=$form->get('addresses')->getData();
            $address=$addressObj->getFirstname()." ".$addressObj->getLastname().'<br>';
            $address .=$addressObj->getAddress().'<br>';
            $address .=$addressObj->getPostal().''.$addressObj->getCity().'<br>';
            $address .=$addressObj->getCountry().'<br>';
            $address .=$addressObj->getPhone().'<br>';

            $order=new Order();
            $order->setCreatedAt(new \DateTime('now'));
            $order->setState(1);
            $order->setCarrier($form->get('carrier')->getData()->getName());      #carrier = carriername
            $order->setCarrierPrice($form->get('carrier')->getData()->getPrice());
            $order->setDelivery($address);

            foreach($carts as $product){
                $orderDetail=new OrderDetail();
                $orderDetail->setProduct($product['object']->getName());
                $orderDetail->setProdcutIllustration($product['object']->getIllustration());
                $orderDetail->setProductPrice($product['object']->getPrice());
                $orderDetail->setProductTva($product['object']->getTva());
                $orderDetail->setProductQuantity($product['qty']);
                $order->addOrderDetail($orderDetail);
            }
            $entityManager->persist($order);
         $entityManager->flush();

        }

        return $this->render('order/summary.html.twig', [
            'choices'=>$form->getData(),
            'cart'=>$cart->getCart(),
            'totalWt'=>$cart->getTotalWt(),
        ]);
    }
}
