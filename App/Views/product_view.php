
<style>
    .product.detail img{
        width: 30%;
    }
    .product.detail{
        transition: none;
    }
    .product.detail:hover{
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
</style>
<div class="product detail">
    <h1><?=$data["title"]?></h1>
    <div class="product-wrapper">
        <img src="<?=$data["photo"]?>" />
        <span><?=$data["description"]?></span>
    </div>
    <div class="reviews">
        <h2>Оставить отзыв</h2>
        <div class="reviews-form">
            <form id="review">
                <input type="hidden" name="item_id" value="<?=$data["id"]?>"/>
                <div class="form-group">
                    <label for="title">Заголовок:</label><br>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="review">Текст отзыва:</label><br>
                    <textarea id="review" name="review" rows="5" cols="40" required></textarea>
                </div>

                <div class="form-group">
                    <label for="rating">Оценка (1-10):</label><br>
                    <input type="number" id="rating" name="rating" min="1" max="10" required>
                </div>

                <input type="submit" value="Отправить отзыв">
            </form>
        </div>
    </div>
    <div class="reviews_list">
        <?foreach ($data['reviews'] as $review) {?>

            <span><?=$review["title"]?></span>
            <span><?=$review["description"]?></span>
            <span><?=$review["rate"]?></span>
        <?}?>
    </div>
</div>