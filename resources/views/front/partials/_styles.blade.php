<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Css Styles -->
<link rel="stylesheet" href="{{ asset('projects/front/css/bootstrap.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/elegant-icons.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/nice-select.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/owl.carousel.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/slicknav.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('projects/front/css/style.css') }}" type="text/css">
<style>
    .custom-link {
        color: #1c1c1c;
        cursor: pointer;
        text-decoration: none;
        position: relative;
    }

    .custom-link:after {
        content: ' \00B7';
        /* Unicode karakteri: Nokta */
        color: black;
        /* Kara renk */
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
    }

    .green-heart {
        color: #7FAD39;
    }

    .green-basket {
        color: #7FAD39;
    }

    .logout-button {
        display: inline-block;
        border: none;
        color: green;
    }

    .profil-img {
        height: 30px;
        width: 30px;
        border-radius: 50%;
    }

    .profil-img img {
        border-radius: 50%;
        object-fit: contain;
        height: 100%;
        width: 100%;
    }

    .letters {
        display: inline-block;
        width: 30px;
        height: 30px;
        background-color: #7FAD39;
        color: #fff;
        text-align: center;
        line-height: 30px;
        text-decoration: none;
        border-radius: 50%;
        font-size: 15px;
        font-weight: bold;
    }

    .profil-page {
        margin: 50px
    }

    .content_custom {
        padding: 100px !important;
        background-color: #7FAD39;
    }

    .product__details__quantity .quantity {
    display: flex;/
    align-items: center; 
}

.product__details__quantity .pro-qty {
    margin-right: 10px;
}
.comment-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.comment-content {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.comment-text {
    margin: 0;
}
.user-initial {
        width: 30px; 
        height: 30px; 
        line-height: 30px; 
        border-radius: 50%; 
        text-align: center; 
        font-size: 1.2em; 
        font-weight: bold;
        background-color: #7FAD39;
         
    }
    .comment-content{
        margin-left: 10px;
       
    }

</style>
