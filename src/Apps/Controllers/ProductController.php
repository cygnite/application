<?php 
namespace Apps\Controllers;

use Apps\Models\Product;
use Apps\Form\ProductForm;
use Cygnite\Common\UrlManager\Url;
use Cygnite\Http\Requests\Request;
use Cygnite\Http\Responses\Response;
use Cygnite\Http\Responses\ResponseInterface;
use Cygnite\Mvc\Controller\AbstractBaseController;

/**
* This file is generated by Cygnite Crud Generator
* You may alter code to fit your need
*/
class ProductController extends AbstractBaseController
{
	// Plain layout
    protected $layout = 'layouts.base';
    
   /*
    | --------------------------------------------------------------------------
    | The Product Controller
    |--------------------------------------------------------------------------
    |  This controller respond to uri beginning with product and also
    |  respond to root url like "product/index"
    |
    | Your GET request of "product/index" will respond like below -
    |
    |     public function indexAction() : ResponseInterface
    |     {
    |         return Response::make("Cygnite : Hello World!!");
    |     }
    |
    */

    /**
    * Default method for your controller. Render index page into browser.
    * @access public
    * @return void
    */
    public function indexAction() : ResponseInterface
    {
        $product = Product::all(['orderBy' => 'id desc',
                /*'paginate' => array(
                    'limit' => Url::segment(3)
                )*/]
        );

        $content = $this->view->create('Apps.Views.product.index', [
            'records' => $product,
            'links' => '', //Product::createLinks(),
            'title' => 'Cygnite Framework - Crud Application',
        ]);

        return new Response($content);
    }

    /**
     * Add a new product
     *
     * @param Request $request
     * @param ProductForm $form
     * @return ResponseInterface
     */
    public function addAction(Request $request, ProductForm $form) : ResponseInterface
    {
        $form->handleRequest('add', $request);

        //Check is valid request and form submitted
        if ($form->isValidRequest() && $form->isSubmitted('btnSubmit')) {
            $product = new Product();

            //Run validation
            if ($product->validate($postArray = $request->post->all())) {

                // get post array value except the submit button
                $product->product_name = $postArray["product_name"];
                $product->category = $postArray["category"];
                $product->description = $postArray["description"];
                $product->validity = $postArray["validity"];
                $product->price = $postArray["price"];
                $product->created_at = $postArray["created_at"];
                $product->updated_at = $postArray["updated_at"];

                // Save form details
                if ($product->save()) {
                    $this->setFlash('success', 'Product added successfully!')
                         ->redirectTo('product/index/');
                } else {
                    $this->setFlash('error', 'Error occured while saving Product!')
                        ->redirectTo('product/index/');
                }

            } else {
                //Set validation instance into form builder to display inline error in form
                $form->setValidator($product->getValidator());
            }
        }

        // We can also use same view page for create and update
        $content = $this->view->create('Apps.Views.product.create', [
            'form' => $form->render(),
            'validation_errors' => $form->getValidationErrors(),
            'title' => 'Add a new Product'
        ]);

        return new Response($content);
    }

    /**
     * Update a product.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editAction(Request $request, $id) : ResponseInterface
    {
        $product = null;
        $product = Product::find($id);
        $form = new ProductForm($product, Url::segment(3));
        $form->handleRequest('edit', $request);

        //Check is valid request and form submitted
        if ($form->isValidRequest() && $form->isSubmitted('btnSubmit')) {

            //Run validation
            if ($product->validate($postArray = $request->post->all())) {

                // get post array value except the submit button
                $product->product_name = $postArray["product_name"];
                $product->category = $postArray["category"];
                $product->description = $postArray["description"];
                $product->validity = $postArray["validity"];
                $product->price = $postArray["price"];
                $product->created_at = $postArray["created_at"];
                $product->updated_at = $postArray["updated_at"];

                // Save form information
                if ($product->save()) {
                    $this->setFlash('success', 'Product updated successfully!')
                        ->redirectTo('product/index/');
                } else {
                    $this->setFlash('error', 'Error occured while saving Product!')
                        ->redirectTo('product/index/');
                }

            } else {
                //validation error here
                $form->setValidator($product->getValidator());
            }
        }

        $content = $this->view->create('Apps.Views.product.update', [
            'form' => $form->render(),
            'validation_errors' => $form->getValidationErrors(),
            'title' => 'Update the Product'
        ]);

        return new Response($content);
    }

    /**
     * Display product details using Id.
     *
     * @param $id
     * @return Response
     */
    public function showAction($id) : ResponseInterface
    {
        $content = $this->view->create('Apps.Views.product.show', [
            'record' => Product::find($id),
            'title' => 'Show the Product'
        ]);

        return new Response($content);
    }

    /**
     * Delete product using id
     *
     * @param type $id
     */
    public function deleteAction($id)
    {
        $product = new Product();

        if ($product->trash($id) == false) {
            $this->setFlash('success', 'Product Deleted Successfully!')
                ->redirectTo('product/');
        } else {
            $this->setFlash('error', 'Error Occured While Deleting Product!')
                ->redirectTo('product/');
        }
    }
}//End of your Product controller
