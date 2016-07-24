<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Session;

AppAsset::register($this);
$session = new Session();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $items = [];

           // if (!empty($session['user'])) {
            //    $user = $session['user'];

           //     if ($user->level == 'admin') {
                    $items = [
                        ['label' => 'User', 'url' => ['/backend/user']],
                        ['label' => 'Produck','url' => ['/backend/product']],
                        ['label' => 'NEWS','url' => ['/backend/news']],
                        ['label' => 'Report'],
                        ['label' => 'Logout', 'url' => ['/backend/logout'],
                            'options' => [
                                'onclick' => 'return confirm("ออกจากระบบ logout")'
                            ]
                        ]
                    ];
            //    }
//                if ($user->level == 'manager') {
//                    $items = [
//                        ['label' => 'Report'],
//                        ['label' => 'Logout', 'url' => ['/backend/logout'],
//                            'options' => [
//                                'onclick' => 'return confirm("logout")'
//                            ]
//                        ]
//                    ];
//                }
            //}

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
