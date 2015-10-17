<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Persona;
use app\models\Departamento;
class SiteController2 extends Controller
{
    
}
class SiteController extends Controller
{
//Formularios
	public function actionFormulariodpto($mensajen=null,$mensajec=null)
    {
        return $this->render('formulariodpto',["mensajen"=>$mensajen,"mensajec"=>$mensajec]);
    }
	
	public function actionFormularioper()
    {
        return $this->render('formularioper');
    }
//Fin Formularios----------------------------------------

//Accion Validar Formularios    
  
    public function actionValidarFormulariodpto()
    {
        $model = new ValidarFormulariodpto;
   
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                //Por ejemplo, consultar en una base de datos
            }
            else
            {
                $model->getErrors();
            }
        }
        
        return $this->render("validarformulariodpto");
    }
//Fin Accion Validar Formularios--------------------------
    
    
    
    
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	
}
