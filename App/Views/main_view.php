
<div class="user-info">
    <?
    if ($userId = \App\User::isLogin()) {
        $objModUser = new \App\Models\ModelUser();
        ?>
        <span>
            <?=$objModUser->getUserEmailById($userId);?>
        </span><?
    } else {
        ?>
        <span><a href='/register/'>Регистрация</a></span>
        <span><a href='/login/'>Вход</a></span>
        <?
    }
    ?>
</div>
<div class="sort-buttons">
    <a href="/?sort=rate"><button class="sort-button <?if(isset($_GET["sort"]) && $_GET["sort"]=='rate'){echo "active";}?>" data-sort="rating">Сортировать по рейтингу</button></a>
    <a href="/?sort=date"><button class="sort-button <?if(isset($_GET["sort"]) && $_GET["sort"]=='date'){echo "active";}?>" data-sort="date">Сортировать по дате</button></a>
</div>
<ul class="product-list">
    <?foreach ($data["ITEMS"] as $item){?>
        <a href="/product?id=<?=$item["ID"]?>">
        <li class="product">
            <img src="<?=$item["PHOTO"]?>" alt="<?=$item["TITLE"]?>">
            <h2><?=$item["TITLE"]?></h2>
            <p><?=$item["TITLE_DESCRIPTION"]?></p>
            <p>Рейтинг: <?=$item["RATING"]?></p>
        </li>
        </a>
    <?}?>
</ul>
