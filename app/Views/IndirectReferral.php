<!doctype html>
<html lang="en">

<head>
    <style>
        body {
            display: flex;
            flex-wrap: wrap;
            font-family: Arial;
            justify-content: center;
        }

        h3 {
            text-align: center;
            padding: 0 10px;
        }

        .tree {
            margin: 18px;
            padding: 0;
        }

        .tree:not(:empty):before,
        .tree:not(:empty):after,
        .tree ul:not(:empty):before,
        .tree ul:not(:empty):after,
        .tree li:not(:empty):before,
        .tree li:not(:empty):after {
            display: block;
            position: absolute;
            content: "";
        }

        .tree ul,
        .tree li {
            position: relative;
            margin: 0;
            padding: 0;
        }

        .tree li {
            list-style: none;
        }

        .tree li>div {
            background-color: yellow;
            color: #222;
            padding: 5px;
            display: inline-block;
        }

        .tree.cascade li {
            margin-left: 24px;
        }

        .tree.cascade li div {
            margin-top: 12px;
        }

        .tree.cascade li:before {
            border-left: 1px solid black;
            height: 100%;
            width: 0;
            top: 0;
            left: -12px;
        }

        .tree.cascade li:after {
            border-top: 1px solid black;
            width: 12px;
            left: -12px;
            top: 24px;
        }

        .tree.cascade li:last-child:before {
            height: 24px;
            top: 0;
        }

        .tree.cascade>li:first-child:before {
            top: 24px;
        }

        .tree.cascade>li:only-child {
            margin-left: 0;
        }

        .tree.cascade>li:only-child:before,
        .tree.cascade>li:only-child:after {
            content: none;
        }

        .tree.horizontal li {
            display: flex;
            align-items: center;
            margin-left: 24px;
        }

        .tree.horizontal li div {
            margin: 6px 0;
        }

        .tree.horizontal li:before {
            border-left: 1px solid black;
            height: 100%;
            width: 0;
            top: 0;
            left: -12px;
        }

        .tree.horizontal li:first-child:before {
            height: 50%;
            top: 50%;
        }

        .tree.horizontal li:last-child:before {
            height: 50%;
            bottom: 50%;
            top: auto;
        }

        .tree.horizontal li:after,
        .tree.horizontal li ul:after {
            border-top: 1px solid black;
            height: 0;
            width: 12px;
            top: 50%;
            left: -12px;
        }

        .tree.horizontal li:only-child:before {
            content: none;
        }

        .tree.horizontal li ul:after {
            left: 0;
        }

        .tree.horizontal>li:only-child {
            margin-left: 0;
        }

        .tree.horizontal>li:only-child:before,
        .tree.horizontal>li:only-child:after {
            content: none;
        }

        .tree.vertical {
            display: flex;
            /* padding-left: 50%; */
        }

        .tree.vertical ul {
            display: flex;
            justify-content: center;
        }

        .tree.vertical li {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tree.vertical li div {
            margin: 39px 30px;
        }

        .tree.vertical li:before {
            border-left: 1px solid black;
            height: 12px;
            width: 0;
            top: 0;
        }

        .tree.vertical li:after {
            border-top: 1px solid black;
            height: 0;
            width: 100%;
        }

        .tree.vertical li:first-child:after {
            border-top: 1px solid black;
            height: 0;
            width: 50%;
            left: 50%;
        }

        .tree.vertical li:last-child:after {
            border-top: 1px solid black;
            height: 0;
            width: 50%;
            right: 50%;
        }

        .tree.vertical li:only-child:after {
            content: none;
        }

        .tree.vertical li ul:before {
            border-left: 1px solid black;
            height: 12px;
            width: 0;
            top: -12px;
        }

        .tree.vertical>li:only-child:before,
        .tree.vertical>li:only-child:after {
            content: none;
        }

        .tree .tree.vertical .cascade,
        .tree.vertical .tree .cascade,
        .tree .tree.vertical.cascade-1>li,
        .tree .tree.vertical.cascade-2>li>ul>li,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li {
            flex-direction: column;
            align-items: start;
            padding: 0 12px;
        }

        .tree .tree.vertical .cascade:before,
        .tree.vertical .tree .cascade:before,
        .tree .tree.vertical.cascade-1>li:before,
        .tree .tree.vertical.cascade-2>li>ul>li:before,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li:before,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:before {
            left: 24px;
        }

        .tree .tree.vertical .cascade:after,
        .tree.vertical .tree .cascade:after,
        .tree .tree.vertical.cascade-1>li:after,
        .tree .tree.vertical.cascade-2>li>ul>li:after,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li:after,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:after {
            left: 0;
        }

        .tree .tree.vertical .cascade:first-child:after,
        .tree.vertical .tree .cascade:first-child:after,
        .tree .tree.vertical.cascade-1>li:first-child:after,
        .tree .tree.vertical.cascade-2>li>ul>li:first-child:after,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li:first-child:after,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:first-child:after {
            left: 24px;
            width: 100%;
        }

        .tree .tree.vertical .cascade:last-child:after,
        .tree.vertical .tree .cascade:last-child:after,
        .tree .tree.vertical.cascade-1>li:last-child:after,
        .tree .tree.vertical.cascade-2>li>ul>li:last-child:after,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li:last-child:after,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li:last-child:after {
            left: 0;
            width: 24px;
        }

        .tree .tree.vertical .cascade ul,
        .tree.vertical .tree .cascade ul,
        .tree .tree.vertical.cascade-1>li ul,
        .tree .tree.vertical.cascade-2>li>ul>li ul,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li ul,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li ul,
        .tree .tree.vertical .cascade li,
        .tree.vertical .tree .cascade li,
        .tree .tree.vertical.cascade-1>li li,
        .tree .tree.vertical.cascade-2>li>ul>li li,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li {
            display: block;
        }

        .tree .tree.vertical .cascade ul:before,
        .tree.vertical .tree .cascade ul:before,
        .tree .tree.vertical.cascade-1>li ul:before,
        .tree .tree.vertical.cascade-2>li>ul>li ul:before,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li ul:before,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li ul:before,
        .tree .tree.vertical .cascade ul:after,
        .tree.vertical .tree .cascade ul:after,
        .tree .tree.vertical.cascade-1>li ul:after,
        .tree .tree.vertical.cascade-2>li>ul>li ul:after,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li ul:after,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li ul:after,
        .tree .tree.vertical .cascade li:before,
        .tree.vertical .tree .cascade li:before,
        .tree .tree.vertical.cascade-1>li li:before,
        .tree .tree.vertical.cascade-2>li>ul>li li:before,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li:before,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:before,
        .tree .tree.vertical .cascade li:after,
        .tree.vertical .tree .cascade li:after,
        .tree .tree.vertical.cascade-1>li li:after,
        .tree .tree.vertical.cascade-2>li>ul>li li:after,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li:after,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:after {
            border: none;
        }

        .tree .tree.vertical .cascade div,
        .tree.vertical .tree .cascade div,
        .tree .tree.vertical.cascade-1>li div,
        .tree .tree.vertical.cascade-2>li>ul>li div,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li div,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li div {
            margin: 0;
            margin-top: 12px;
        }

        .tree .tree.vertical .cascade li,
        .tree.vertical .tree .cascade li,
        .tree .tree.vertical.cascade-1>li li,
        .tree .tree.vertical.cascade-2>li>ul>li li,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li {
            margin-left: 24px;
        }

        .tree .tree.vertical .cascade li:before,
        .tree.vertical .tree .cascade li:before,
        .tree .tree.vertical.cascade-1>li li:before,
        .tree .tree.vertical.cascade-2>li>ul>li li:before,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li:before,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:before {
            border-left: 1px solid black;
            height: 100%;
            width: 0;
            top: 0;
            left: -12px;
        }

        .tree .tree.vertical .cascade li:after,
        .tree.vertical .tree .cascade li:after,
        .tree .tree.vertical.cascade-1>li li:after,
        .tree .tree.vertical.cascade-2>li>ul>li li:after,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li:after,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:after {
            border-top: 1px solid black;
            width: 12px;
            height: 0;
            left: -12px;
            top: 24px;
            content: "";
        }

        .tree .tree.vertical .cascade li:last-child:before,
        .tree.vertical .tree .cascade li:last-child:before,
        .tree .tree.vertical.cascade-1>li li:last-child:before,
        .tree .tree.vertical.cascade-2>li>ul>li li:last-child:before,
        .tree .tree.vertical.cascade-3>li>ul>li>ul>li li:last-child:before,
        .tree .tree.vertical.cascade-4>li>ul>li>ul>li>ul>li li:last-child:before {
            height: 24px;
            top: 0;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <?php
    include "Partials/Navbar.php";
   
    ?>
<div class="container m-5">
     <h1> List of all Indirect Referral</h1><hr><br>
<table class="table table-hover">
  <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">level</th>
      <th scope="col">First Name</th>
      <th scope="col">Referral ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // print_r($level);exit;
    if(isset($level)){
        foreach($level as $direct){
        ?>
        <tr>
            <td><?= $direct['id'] ?></td>
            <th><?= $direct['level']-1 ?></th>
      <td><?= $direct['f_name'] ?></td>
      <td><?= $direct['referralid'] ?></td>
    </tr>

        <?php
        }
    }

?>
    
    
  </tbody>
</table>
</div>




    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>