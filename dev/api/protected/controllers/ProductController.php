<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class ProductController extends Controller
{
    public function actionIndex( $id = 0 ) {
        if( $id != 0 ) {
            $product    = $this->_get_product( intval( $id ) );

            $this->setOutput('product', array_merge( $product->attributes, array(
                'purchased' => (count($product->users)) ? 1 : 0,
            )));
        } else {
            $products   = $this->_get_products();
            $this->setOutput('products', $products);
        }
    }

    /**
     * Retrieve a single product by ID.
     * @param int $id
     * @return Model_Product
     */
    protected function _get_product($id)
    {
        $product = Products::model()->with(array('users'=>array('joinType'=>'LEFT JOIN','on'=>'users_users.user_id='.self::$user->id)))
                                    ->findByPk( $id );
        if($product ) {
            return $product;
        } else {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Product not defined!"));
        }
    }

    /**
     * Retrieve all defined products.
     * @return array
     */
    protected function _get_products()
    {
        $raw = Products::model()->with(array('users'=>array('joinType'=>'LEFT JOIN','on'=>'users_users.user_id='.self::$user->id)))
                                ->findAll( 't.delete_date IS NULL' );

        $products   = array();
        foreach( $raw as $product ) {
            $raw = Contents::model()->findAll( 'product_id=' . $product->id );
            $product_content = array();
            foreach ($raw as $content) {
                $product_content[] = $content->attributes;
            }
            $products[] = array_merge($product->attributes, array(
                'purchased' => (count($product->users)) ? 1 : 0,
                'content'   => $product_content,
            ));
        }
        return $products;
    }
}