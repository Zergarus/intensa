
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
<ul class="product-list">
    <?foreach ($data["ITEMS"] as $item){?>
        <a href="/product?id=<?=$item["ID"]?>">
        <li class="product">
            <img src="<?=$item["PHOTO"]?>" alt="<?=$item["TITLE"]?>">
            <h2><?=$item["TITLE"]?></h2>
            <p><?=$item["TITLE_DESCRIPTION"]?></p>
        </li>
        </a>
    <?}?>
</ul>
