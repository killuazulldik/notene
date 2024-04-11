<?php session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/style_dash.css" />
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="header">WELCOME BACK <br><?php echo $user_name; ?>,</div>
            <ul class="he">
                <li><a href="#">Favorite</a></li>
                <li><a href="#">Archive</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="right">
                <h1>noteNest</h1>
            </div>

            <section class="home">


                <div class="popup-box">
                    <div class="popup">
                        <div class="content">
                            <header>
                                <p></p>
                                <i class="uil uil-times"></i>
                            </header>
                            <form action="insert_note.php" method="POST">
                                <div class="row title">
                                    <label>Title</label>
                                    <input type="text" name="title" spellcheck="false" />
                                </div>
                                <div class="row description">
                                    <label>Description</label>
                                    <textarea name="description" spellcheck="false"></textarea>
                                </div>
                                <button></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="wrapper">
                    <li class="add-box">
                        <div class="icon"><i class="uil uil-plus"></i></div>
                        <p>Add new note</p>
                    </li>
                </div>
            </section>
        </div>
    </div>

    <script src="js/js.js"></script>
</body>

</html>