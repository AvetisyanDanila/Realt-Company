<?php 
$contribution = $_POST['user_contribution'];
$bank = $_POST['user_bank'];
$term = $_POST['user_term'];
$price = $_POST['user_price'];

// Расчёт итоговой цены в зависимости от первоначального взноса
$contribution_in_percents = $contribution/100;
$total_price = $price - ($price * $contribution_in_percents);

// Выбор ставки в зависимости от выбранного банка
if ($bank == "Сбербанк") {
    $rate_not_in_shares = 13;
    $rate = 0.13;
} elseif ($bank == "Альфа-банк") {
    $rate_not_in_shares = 10;
    $rate = 0.1;
} elseif ($bank == "Тинькофф Банк") {
    $rate_not_in_shares = 12;
    $rate = 0.12;
}

// Расчет ежемесячного(Аннуитетного) платежа
$number_of_payments = $term*12;
$monthly_rate = $rate/12;
$one_plus_monthly_rate = 1+$monthly_rate;
$one_plus_monthly_rate_pow = pow($one_plus_monthly_rate, $number_of_payments);

$monthly_payment = $total_price*(($monthly_rate*$one_plus_monthly_rate_pow)/($one_plus_monthly_rate_pow - 1));

// Расчёт начисленных процентов
$accrued_interest = $monthly_payment*$number_of_payments - $total_price;

// Долг + проценты
$total = $total_price + $accrued_interest;
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Realt Company</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

    <header class="header js-nav-menu">
        <div class="container p-0">
            <div class="header__body">
                <a href="index.html" class="logo"><img src="img/logo.svg" alt="no image"></a>
                <a class="header__button js-button-first"><span>Обратный звонок</span></a>
            </div>
        </div>
    </header>

    <section class="reg" id="reg">
        <div class="container p-0">
            <div class="reg__body">
                <h1 class="reg__title">Итого</h1>
                <?php 
                    // Нужный падеж для срока кредита
                    function num2word($num, $words) {
                        $num = $num % 100;
                        if ($num > 19) {
                            $num = $num % 10;
                        }
                        switch ($num) {
                            case 1: {
                                return($words[0]);
                            }
                            case 2: case 3: case 4: {
                                return($words[1]);
                            }
                            default: {
                                return($words[2]);
                            }
                        }
                    }
                    echo "Стоимость: ".number_format($price, -3, ' ', ' ')." млн. руб."."<br>";
                    echo "<br>";
                    echo "Первоначальный взнос: ".$contribution." %"."<br>";
                    echo "<br>";
                    echo "Срок: ".$term.num2word($term, array(' год', ' года', ' лет'))."<br>";
                ?>
                <div class="line"></div>
                <?php
                    echo "Банк: ".$bank."<br>";
                    echo "<br>";
                    echo "Ставка: ".$rate_not_in_shares." %"."<br>";
                    echo "<br>";
                    echo "Ежемесячный платеж: ".number_format($monthly_payment, -3, ' ', ' ')." руб."."<br>";
                    echo "<br>";
                    echo "Начисленные проценты: ".number_format($accrued_interest, -3, ' ', ' ')." руб."."<br>";
                    echo "<br>";
                    echo "Долг + проценты: ".number_format($total, -3, ' ', ' ')." руб."."<br>";
                ?>
                <a href="index.html" class="reg__button">Вернуться на главную</a>
            </div>
        </div>
    <section>

    <footer class="footer reg-footer" id="footer">
        <div class="container-fluid">
            <div class="footer__body">
                <div class="footer_left">
                    <a href="#intro">
                        <div class="footer__logo"><img src="img/footer/logo.svg" alt="Логотип"></div>
                    </a>
                    <div class="footer__contacts">
                        <div class="footer__phone">
                            <img src="img/footer/phone.svg" alt="Телефон: ">
                            <a href="tel:+74953406010">+7 (495) 340 60 10</a>
                        </div>
                        <div class="footer__phone">
                            <img src="img/footer/phone.svg" alt="Телефон: ">
                            <a href="tel:+74953406011">+7 (495) 340 60 11</a>
                        </div>
                        <div class="footer__address">
                            <img src="img/footer/mark.svg" alt="Адресс: ">
                            <a href="#footer">105318, г. Москва, ул. Щербаковская, 3</a>
                        </div>
                        <div class="footer__email">
                            <img src="img/footer/email.svg" alt="Почта: ">
                            <a href="mailto:realt-company@gmail.com">realt-company@gmail.com</a>
                        </div>
                    </div>
                </div>
                <div class="footer-socials">
                    <ul class="footer-socials__list">
                        <li class="footer-socials__item">
                            <a href="https://www.facebook.com" target="_blank">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="fa fa-facebook" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li class="footer-socials__item">
                            <a href="https://vk.com" target="_blank">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="fa fa-vk" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li class="footer-socials__item">
                            <a href="https://www.instagram.com" target="_blank">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="fa fa-instagram" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <iframe class="footer__map" style="display: block; margin: 0 auto; margin-top: 30px;" src="https://yandex.ru/map-widget/v1/?um=constructor%3A81a3723a5227379a3ca0068ac4e352525941db316c915cf487e2b723d3a724c6&amp;source=constructor" width="70%" height="400" frameborder="0"></iframe>
            <span class="footer__copyright">Все права данного сайта очень надежно защищены правообладателем, даже не пытайтесь повторить сайт (особенно соц. сети).</span>
        </div>
    </footer>

    <div class="overlay js-overlay-first">
        <div class="popup js-popup-first">
            <div class="close-popup js-close-first"></div>
            <form class="form-popup" action="mail.php" method="POST">
                <h1 class="form-popup__title">Заказать звонок</h1>
                <div class="form__block form-popup__block">
                    <div class="form-popup__text">
                        <span class="form__span">Имя</span>
                        <input type="text" name="user_name" pattern="^[A-Za-zА-Яа-яЁё\s]+$" required>
                    </div>
                </div>
                <div class="form__block form-popup__block">
                    <div class="form-popup__text">
                        <span class="form__span">Телефон</span>
                        <input type="text" name="user_phone" class="form__phone" required>
                    </div>
                </div>
                <div class="form__block form-popup__block">
                    <div class="form__select form-popup__select select1">
                        <span class="form__span">Когда вам удобно получить звонок?</span>
                        <select name="user_settime" required>
                            <option value="" selected disabled>Выберите время...</option>
                            <option value="Завтра утром">Завтра утром</option>
                            <option value="Завтра днём">Завтра днём</option>
                            <option value="Завтра вечером">Завтра вечером</option>
                        </select>
                    </div>
                </div>
                <label class="form-popup__label">
                    <input type="checkbox" class="form-popup__radio" required>
                    <span class="form-popup__span"><span class="form-popup__span_light">Я согласен на обработку</span> персональных данных и с условиями пользовательского соглашения</span>
                </label>
                <button type="submit" class="form__btn form-popup__btn">Заказать звонок</button>
            </form>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>