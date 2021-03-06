<?php
  $this->load->view('/_shared/header_tpl');
?>
<body class="main">

<div class="wrap">

    <div id="header">
      <a class="logo" href="/"></a>
        
      <div class="links">
        <a href="/welcome/authentication/"><span><span>Войти</span></span></a>
        <a class="active" href="/welcome/registration/"><span><span>Зарегистрироваться</span></span></a>
      </div>
        
      <div class="text_block">
      
        <div class="left">LadyAds.ru - уникальная<br />женская тизерная сеть!</div>
        
        <div class="right">Представляем вам LadyAds.ru – инновационную<br />тизерную сеть, ориентированную на высокий доход!</div>
      
      </div>
    
    </div>
    
    <div id="text_block1">Мы выкупаем трафик напрямую без комиссии, гарантируя вам максимальную ставку за клик!<br />Реализуем товары, инфопродукты повышенного спроса ориентированные на женскую аудиторию.</div>
    
    <div id="blocks">
        
        <h1>Ваши выгоды:</h1>
        
        <div class="block">
            
            <div class="icon">
                <img src="/css/welcome/images/icon1.png" width="133" height="132" border="0" alt="*" />
            </div>
            
            <div class="hd">Прозрачность</div>
            
            <div class="text">Удобная система<br />статистики в реальном<br />времени.</div>
            
        </div>
        
        <div class="block">
            
            <div class="icon">
                <img src="/css/welcome/images/icon2.png" width="133" height="132" border="0" alt="*" />
            </div>
            
            <div class="hd">Гибкий конструктор</div>
            
            <div class="text">Вы с легкостью подберете<br />блок подходящий вашему<br />дизайну.</div>
            
        </div>
        
        <div class="block">
            
            <div class="icon">
                <img src="/css/welcome/images/icon3.png" width="133" height="132" border="0" alt="*" />
            </div>
            
            <div class="hd">Персональный подход</div>
            
            <div class="text">Вас обслуживает ваш<br />личный менеджер.<br />Саппорт  24/7.</div>
            
        </div>
        
        <div class="block">
            
            <div class="icon">
                <img src="/css/welcome/images/icon4.png" width="133" height="132" border="0" alt="*" />
            </div>
            
            <div class="hd">Высокие отчисления</div>
            
            <div class="text">От 2.5 рублей клик РФ<br />От 1.5 рублей клик СНГ</div>
            
        </div>
        
        <div class="block">
            
            <div class="icon">
                <img src="/css/welcome/images/icon5.png" width="133" height="132" border="0" alt="*" />
            </div>
            
            <div class="hd">Тизеры<br />с высоким CTR</div>
            
            <div class="text">Мы обеспечим максимум<br />кликов на любом сайте<br />женской тематики.</div>
            
        </div>
        
        <div class="block">
            
            <div class="icon">
                <img src="/css/welcome/images/icon6.png" width="133" height="132" border="0" alt="*" />
            </div>
            
            <div class="hd">Выплаты</div>
            
            <div class="text">Каждый понедельник.<br />За прошедшую неделю.</div>
            
        </div>
        
    </div>
    
    <div id="footer">
        
      <h2>Специальные условия для постоянных партнёров!</h2>

      <div class="text1">Зарегистрируйтесь прямо сейчас, получите – максимально выгодные и комфортные условия для заработка.</div>
        
      <div class="text2">LadyAds.ru<br />с нами выгодно!</div>
        
      <div class="button">
        <a href="/welcome/registration/"></a>
      </div>
        
      <?php $this->load->view('/_shared/welcome_copyright_tpl'); ?>

      <h2>Примеры тизерного блока!</h2>
      <div id="teaser_458"><img src="http://ladyads.ru/images/preolader.gif" /></div><script async type="text/javascript" src="http://ladyads.ru/_shared/show/index/458"></script>
      <br /><br />
    </div>

</div>
<?php $this->load->view('/_shared/welcome_footer_details_tpl'); ?>
</body>
</html>