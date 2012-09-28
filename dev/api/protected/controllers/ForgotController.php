<?php 
Yii::import('ext.logger.CPSLiveLogRoute');
class ForgotController extends CController
{
	public function actionIndex() {        
        $email = Yii::app()->request->getPost('email');

        if( !$email ) {
            //$this->template->content = View::factory('account/forgot');
            $this->renderPartial('forgot');
            Yii::app()->end();
        }

        //$email = ORM::factory('person_email')->where('email_address','=',$email)->find();
        //foreach(ORM::factory('person_email')->where('email_address','=',$email)->find_all() AS $emailResult)
        //{
        //      $email = $emailResult->person->where('facebook_id', 'IS', 'NULL');;
        //}

        $email = PersonEmails::model()->with( 'person' )->find( 'email_address=:email_address AND person.facebook_id IS NULL AND person.twitter_handle IS NULL', array( ':email_address' => $email ) );
        
        if ( $email ) {
            $person = $email->person;
            if ( $person ) {
                $user = $person->users[0];
                if ( $user ) {

                    // generate a new password
                    $new_passwd = substr( base64_encode( uniqid() ), -10, 6 );
                    $new_passwd = str_replace(array('1', 'l', '0', 'O', 'o'), array('5', '3', 'G', '9', '9'), $new_passwd);                 
                    // save the user record
                    $user->passwd = md5($new_passwd);
                    $user->save();
                    $email_addr = $email->email_address;
                    $body = $this->render( 'email/forgot', array(
                        'password'=> $new_passwd,
                        'email' => $email_addr
                    ), true );

                    $email = Yii::app()->email;
                    $email->to = $email_addr; //, $inputs['first_name'].' '.$inputs['last_name'];
                    $email->from = 'no-reply@tonguetango.com'; //, 'Tongue Tango';
                    $email->subject = 'Tt Password Reset';
                    $email->message = $body;
                    $email->send();

                    $this->renderPartial('forgot', array( 'sent' => true ));
                    Yii::app()->end();
                }
            }
        } else {
            $this->redirect('/forgot');
        }
    }
}