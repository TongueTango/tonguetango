<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class ProductController extends Controller
{
    public function actionIndex( $id = 0 ) {
        if( $id != 0 ) {
            $product    = $this->_get_product( intval( $id ) );

            $this->setOutput('product', array_merge( $product->attributes, array(
                'purchased' => $product->has( self::$user->id )
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
        $product = Products::model()->findByPk( $id );
        if( count( $product ) ) {
            return $product;
        } else {
            throw new Exception('Product not defined!', 400);
        }
    }

    /**
     * Retrieve all defined products.
     * @return array
     */
    protected function _get_products()
    {
        $raw = Products::model()->findAll( 'delete_date IS NULL' );

        $products   = array();
        foreach( $raw as $product ) {
            $raw = Contents::model()->findAll( 'product_id=' . $product->id );
            $product_content = array();
            foreach ($raw as $content) {
                $product_content[] = $content->attributes;
            }
            $products[] = array_merge($product->attributes, array(
                'purchased' => $product->has( self::$user->id ),
                'content'   => $product_content,
            ));
        }
        return $products;
    }
}