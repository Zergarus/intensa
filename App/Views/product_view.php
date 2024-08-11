<style xmlns="http://www.w3.org/1999/html">
    .product.detail img {
        width: 350px;
    }

    .product.detail {
        transition: none;
        cursor: default;
    }

    .product.detail:hover {
        transform: scale(1);
    }

    .product-wrapper {
        display: flex;
    }

    .product-wrapper span {
        margin-left: 40px;
        padding-right: 40px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #3f51b5;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    input[type="text"],
    textarea,
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    input[type="submit"] {
        background-color: #3f51b5;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #303f9f;
    }

    .reviews-form {
        padding-right: 700px;
    }

    .reviews_list {
        margin-top: 40px;
    }

    h1, span, label {
        color: #566bce
    }
    .reviews_detail {
        display: flex;
        flex-direction: column;
        border-top: 1px solid #32258a;
        border-bottom: 1px solid #32258a;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }
    .grade{
        font-weight: 700;
    }
    .review_control {
        margin-top: 10px;
        display: flex;
    }
    .delete {
        margin-left: 10px;
    }
    .product.detail a {
        cursor: pointer;
    }
    .reviews-form {
        margin-top: 15px;
    }
</style>
<div class="product detail">
    <h1><?= $data["title"] ?></h1>
    <div class="product-wrapper">
        <img src="<?= $data["photo"] ?>"/>
        <span><?= $data["description"] ?></span>
    </div>
    <div class="reviews">
        <?if($user_id = \App\User::isLogin()):?>
        <h2>Оставить отзыв</h2>
        <div class="reviews-form">
            <form id="review">
                <input type="hidden" name="item_id" value="<?= $data["id"] ?>"/>
                <input type="hidden" name="author_id" value="<?=$user_id?>" />
                <div class="form-group">
                    <label for="title">Заголовок:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="description">Текст отзыва:</label>
                    <textarea id="description" name="description" rows="5" cols="40" required></textarea>
                </div>

                <div class="form-group">
                    <label for="rate">Оценка (1-10):</label>
                    <input type="number" id="rate" name="rate" min="1" max="10" required>
                </div>

                <input type="submit" value="Отправить отзыв">
            </form>
        </div>
        <?endif;?>
    </div>
    <div class="reviews_list">
        <?$user = \App\User::isLogin();?>
        <? foreach ($data['reviews'] as $review) { ?>
            <div class="reviews_detail">
                <span><?= $review["title"] ?></span>
                <span><?= $review["description"] ?></span>
                <span>Оценка: <span class="grade"><?= $review["rate"] ?></span></span>
                <?if($user == $review["author_id"]):?>
                <div class="review_control">
                    <a class="update" data-id="<?=$review["id"]?>" href="#"><span>Изменить</span></a><br />
                    <a class="delete" data-id="<?=$review["id"]?>" data-item-id="<?= $data["id"] ?>" href="#"><span>Удалить</span></a>
                </div>
                <div class="reviews-form" data-item-id="<?=$review["id"]?>" style="display: none">
                    <form id="review_update">
                        <input type="hidden" name="item_id" value="<?= $data["id"] ?>" />
                        <input type="hidden" name="review_id" value="<?= $review["id"] ?>" />
                        <input type="hidden" name="author_id" value="<?=$user_id?>" />
                        <div class="form-group">
                            <label for="title">Заголовок:</label>
                            <input type="text" id="title" name="title" value="<?= $review["title"] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Текст отзыва:</label>
                            <textarea id="description" name="description" rows="5" cols="40" required><?= $review["description"] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rate">Оценка (1-10):</label>
                            <input type="number" id="rate" name="rate" min="1" max="10" value="<?= $review["rate"] ?>" required>
                        </div>
                        <input type="submit" value="Изменить">
                    </form>
                </div>
            <?endif;?>
            </div>
        <? } ?>
    </div>
</div>