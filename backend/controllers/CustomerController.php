<?php

namespace backend\controllers;

use Yii;
use common\models\Customer;
use common\models\Location;
use common\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\CommonFunctionController;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends CommonFunctionController
{
    /**
     * @inheritdoc
     */

    public $List_Location_Arr;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    function init()
    {
        $query = Location::find();

        $Locations = $query->orderBy('zip_code')
                            ->all();
        foreach ($Locations as $Location_sub_arr):
            $this->List_Location_Arr[$Location_sub_arr->zip_code] = $Location_sub_arr->zip_code;
        endforeach;
    }

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $Customer_Arr = Customer::find()->orderBy('cust_name')
                              ->all();

        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,'Customer_Arr'=>$Customer_Arr,]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!yii::$app->user->can('create customer'))
        {
            return $this->render('notallowed');
            exit;
        }

        $model = new Customer();

        if ($model->load(Yii::$app->request->post())) {

            $model->cust_id = $this->getMaxId('customer','cust_id');

            if(!$model->save()){
              \Yii::$app->getSession()->setFlash('response_msg', 'Record Not Saved ..');
            }
            else{
              \Yii::$app->getSession()->setFlash('response_msg', 'Record Saved Successful..');
            }
            //return $this->redirect(['view', 'id' => $model->cust_id]);
            //$searchModel = new CustomerSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->redirect('index');
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'List_Location_Arr'=>$this->List_Location_Arr,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!yii::$app->user->can('edit customer'))
        {
            return $this->render('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->cust_id]);
            //$searchModel = new CustomerSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->redirect('index');
        } else {
            return $this->render('update', ['model' => $model,'List_Location_Arr' => $this->List_Location_Arr,]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!yii::$app->user->can('delete customer'))
        {
            return $this->render('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
        //$searchModel = new CustomerSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->redirect('index');

        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionGetlocation($Company_Id = null)
    {
        $List_Data_Str = '';
        if(isset($_REQUEST['zip_code']) && $_REQUEST['zip_code']){
            $model = new Location();

            $query1 = Location::find();
            $List_Branches_Arr = array();
        
            $Location_Data = $query1->select(['city', 'province'])
                                ->where(['zip_code' => $_REQUEST['zip_code']])
                                ->all();

            foreach ($Location_Data as $Location_sub_arr):
                $List_Data_Str = $Location_sub_arr->city."#".$Location_sub_arr->province;
            endforeach;
        }

        echo $List_Data_Str;
        exit;
    }

}
