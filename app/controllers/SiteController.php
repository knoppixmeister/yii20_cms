<?php
	namespace app\controllers;

	defined('YII_APP') || die('Direct access to script denied!');

	use yii\filters\AccessControl;
	use yii\web\Controller;
	use yii\filters\VerbFilter;
	use app\models\LoginForm;
	use app\models\ContactForm;
	use yii\helpers\VarDumper;
	use app\models\SiteIndexSearch;
	use app\helpers\Url;

	class SiteController extends \app\components\AppController {
		public function behaviors() {
			$config = 	[
							/*
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
				            /*
				            'verbs' => [
				                'class' => VerbFilter::className(),
				                'actions' => [
				                    'logout' => ['post'],
				                ],
				            ],
				            */
						];
			/*
			if(!empty(\Yii::$app->cache)) {
				$config[] =	[
								'class'		=>	'yii\filters\PageCache',
								'only' 		=>	['login'],
				            	'duration' 	=>	1*60,//1 min.
				            	/*
				            	'variations' => [
									\Yii::$app->language,
				            	],
				            	'dependency' => [
				            		'class' => 'yii\caching\DbDependency',
				            		'sql' => 'SELECT COUNT(*) FROM post',
				            	],
				            	*
							];
			}
			*/
			return $config;
		}
		/*
		public function actions() {
			return [
	            'error' => [
	                'class' => 'yii\web\ErrorAction',
	            ],
	            'captcha' => [
	                'class' 			=>	'yii\captcha\CaptchaAction',
	                'fixedVerifyCode'	=>	true ? 'testme' : null,
	            ],
	        ];
		}
		*/
		public function actionIndex() {
			//if(\Yii::$app->getUser()->isGuest)
			//return $this->render('index', []);

			$this->redirect(Url::to(['/ru']));
		}

		public function actionHome() {
			return $this->render('index', []);
		}

		public function actionLogin() {
			if(!\Yii::$app->user->isGuest) return $this->goHome();

			$model = new LoginForm;
			if($model->load(\Yii::$app->request->post()) && $model->login()) {
	            return $this->goBack();
			}
			else return $this->render('login', ['model' => $model]);
		}

		public function actionLogout() {
	        \Yii::$app->user->logout();

	        return $this->goHome();
		}

		public function actionRegister() {

			return $this->render('register', []);
		}

		public function actionContact() {
	        $model = new ContactForm;

			if($model->load(\Yii::$app->request->post()) && $model->contact(\Yii::$app->params['adminEmail'])) {
	            Yii::$app->session->setFlash('contactFormSubmitted');

	            return $this->refresh();
	        }
			else return $this->render('contact', ['model' => $model]);
		}

		public function actionError() {
			$this->layout = false;
			//return $this->render('error', []);

			echo 'ERROR<br/>';
			//VarDumper::dump(\Yii::$app->getErrorHandler()->exception, 1000, true);
		}
	}