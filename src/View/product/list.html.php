<?php

use Model\Entity\Product;
use Service\Product\ProductSorter;
use Comparator\NameComparator;
use Comparator\PriceComparator;

/**
 * @var Closure $renderLayout 
 * @var Product[] $productList
 * @var Closure $path
 */

$body = function () use ($productList, $path) {
?>
    <table cellpadding="40" cellspacing="0" border="0">
        <tr><td colspan="3" align="center">Наши курсы</td></tr>
        <tr>
            <td colspan="3" align="left">Сортировать по:
                <a href="<?= $path('product_list') ?>?sort=price">Цене</a>
                <a href="<?= $path('product_list') ?>?sort=name">Названию</a>
            </td>
        </tr>

        <?php for ($i = 0; $i < count($productList);): ?>
            <tr>
                <?php for ($col = 0; $col < 3; $col++, $i++): ?>
                    <td style="text-align: center">
                        <a href="<?= $path('product_info', ['id' => $productList[$i]->getId()]) ?>"><?= $productList[$i]->getName() ?></a>
                        <br /><br />
                        <?= $productList[$i]->getPrice() ?> руб.
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
<?php
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Курсы',
        'body' => $body,
    ]
);

$nameSorter = new ProductSorter(new NameComparator());
$priceSorter = new ProductSorter(new PriceComparator());

$nameSorterArray = $nameSorter->sort($productList);
$priceSorterArray = $priceSorter->sort($productList);
