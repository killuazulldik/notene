<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">


</head>
<style>
    .pic {
        width: 100%;
        background-color: red;
        display: flex;
    }

    .rightpic {
        position: flex;
        background: #6BBD99;
        max-width: 450px;
        margin: auto;
        height: 50vh;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(white);

    }

    .tt {
        display: flex;
        justify-content: center;
        margin-top: 20px;

    }

    .txt {
        display: flex;
        justify-content: center;
        margin: 15px 35px 0 35px;
    }

    .btn_txt {
        display: flex;
        justify-content: center;
        margin-top:100px
    }

    .btn_txt button {
        /* display:flex;
        justify-content: center;
        background:#C1E8FF; */
        justify-content: center;
        border: ;
        padding:5px;
     
    
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        background: #AECFA4;
        /* background: linear-gradient(-135deg, #c850c0, #4158d0); */
        transition: all 0.3s ease;
    }

    form .field input[type="submit"] {
        color: #080808;
        border: none;
        padding-left: 0;
        margin-top: -10px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        background: #AECFA4;
        /* background: linear-gradient(-135deg, #c850c0, #4158d0); */
        transition: all 0.3s ease;
    }

    #sid h1 {
        color: white:
    }
</style>

<body>


    <?php
    include_once "nav/header.php";
    ?>


    <div class="pic">
        <div class="leftpic">
            <img src="image/clinic.jpg" alt="">
        </div>
        <div class="rightpic">
            <div class="tt">
                <h1>note </h1>
                <h1 id=sid>Nest</h1>
            </div>
            <div class="txt">
                <p>
                    Step into NoteNest, where your ideas find their rightful home amidst a vibrant community founded on
                    expression, connection, and empowerment. Embrace the liberty to share your creativity, stories, and
                    contemplations without restraint.Come, unfurl your intellect and let your
                    thoughts dance among the stars with NoteNest.
                </p>
            </div>
            <div class="btn_txt">
                <a href="dash.php"><button>Dashboard</button></a>
            </div>


        </div>
    </div>
</body>

</html>