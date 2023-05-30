<?php

use models\Order;
use models\User;

/** @var int $countOfUsers */
/** @var int $countOfProducts */
/** @var int $countOfOrdersToday */
/** @var int $salesInDays */
/** @var int $priceCategories */
/** @var int $breadthOfBrands */

\core\Core::getInstance()->pageParams['title'] = 'Your orders';
?>

<h1 class="h3 mb-4 fw-normal">Orders</h1>

<div class="wrapper-user">
    <div class="hor-menu">
        <a href="/user"><div class="menu-item">Orders</div></a>
        <a href="/user/statistics"><div class="menu-item selected">Statistics</div></a>
    </div>
    <div class="statistics-wrapper">
        <div class="plates">
            <div class="plate">
                <span class="plate-name">Count Of Users</span>
                <span class="plate-value"><?=$countOfUsers?></span>
            </div>
            <div class="plate">
                <span class="plate-name">Count Of Products</span>
                <span class="plate-value"><?=$countOfProducts?></span>
            </div>
            <div class="plate">
                <span class="plate-name">Orders Today</span>
                <span class="plate-value"><?=$countOfOrdersToday?></span>
            </div>
        </div>
        <div class="chart-container">
            <h3>Orders in Last Days</h3>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>Pricing Policy in the Store</h3>
            <canvas id="pricesChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>Breadth of Brands</h3>
            <canvas id="brandsChart"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxSales = document.getElementById('salesChart').getContext('2d');

    const salesData = <?=json_encode(array_column($salesInDays, 'count'))?>;
    const labelsData = <?=json_encode(array_column($salesInDays, 'date'))?>;

    var chartSales = new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: labelsData,
            datasets: [{
                label: "Sales Level Chart",
                data: salesData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0 // Отображать только целые числа на шкале Y
                    }
                }
            }
        }
    });


    const ctxPrice = document.getElementById("pricesChart").getContext("2d");

    const categories = <?=json_encode(array_column($priceCategories, 'category'))?>;
    const countByCategory = <?=json_encode(array_column($priceCategories, 'count'))?>;

    const chartPrice = new Chart(ctxPrice, {
        type: "bar",
        data: {
            labels: categories,
            datasets: [
                {
                    label: "Products Categories by price",
                    data: countByCategory,
                    backgroundColor: ["rgba(54, 162, 235, 0.2)", "rgba(255, 206, 86, 0.2)", "rgba(255, 99, 132, 0.2)"],
                    borderColor: ["rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)", "rgba(255, 99, 132, 1)"],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0,
                },
            },
        },
    });



    const brands = <?=json_encode(array_column($breadthOfBrands, 'brand'))?>;
    const counts = <?=json_encode(array_column($breadthOfBrands, 'count'))?>;

    const ctx = document.getElementById("brandsChart").getContext("2d");
    const myChart = new Chart(ctx, {
        type: "polarArea",
        data: {
            labels: brands,
            datasets: [
                {
                    label: "Count of products",
                    data: counts,
                    backgroundColor: [ "rgba(230,25,75,0.2)", "rgba(60,180,75,0.2)", "rgba(255,225,25,0.2)", "rgba(0,130,200,0.2)", "rgba(245,130,49,0.2)", "rgba(145,30,180,0.2)", "rgba(70,240,240,0.2)"],
                    borderColor: ["#e6194b", "#3cb44b", "#ffe119", "#0082c8", "#f58231", "#911eb4", "#46f0f0"],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0,
                },
            },
        },
    });

</script>

<style>
    .wrapper-user {
        display: flex;
        gap: 50px;
    }

    .hor-menu {
        margin-top: 40px;
        gap: 5px;
    }

    .hor-menu .menu-item {
        width: 200px;
        font-size: 20px;
        text-align: center;
        padding: 25px;

        cursor: pointer;
        border: 2px solid #f3f3f7;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        transition: all 400ms;
    }

    .hor-menu .menu-item:hover,
    .hor-menu .menu-item.selected {
        background-color: #66E5B3;
        color: white;
    }


    .hor-menu .menu-item + .menu-item {
        margin-top: 5px;
    }

    .statistics-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 40px;
    }

    .plates {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 10px;
    }

    .plate {
        height: 150px;
        text-align: center;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding: 30px 60px;
        border: 2px solid #f3f3f7;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 22px;
    }

    .plate:hover {
        background-color: #EDFFF7;
    }

    .plate-value {
        font-weight: 600;
    }

    .chart-container {
        width: 800px;
    }
</style>