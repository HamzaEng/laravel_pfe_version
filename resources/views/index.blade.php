<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Etudiant</title>
    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }

        header {
            height: 60px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            margin: 30px;
            position: relative;
        }

        img {
            display: inline-block;
            background-color:red;
            position: fixed;            
        }

        .img1 {
            right: 30px;
            top: 10px;
        }

        .img2 {
            left: 30px;
            top: 30px;
        }

        article {
            margin: 30px;
        }

        h3 {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        span {
            font-weight: bold;
            margin-right: 10px;
        }

        b {
            font-weight: normal;
        }

        main {
            border: 1px solid gray;
            border-radius: 3px;
            padding: 1rem;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
            font-style: italic;
            color: #777;
        }
    </style>

</head>

<body>
    <header>
        <img class="img1" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3dyOLD39H9Vl5Gnc5DZgiuslwyO9aFiAMGGZMCTcUGQ&s"
        alt="bts" width="100" height="auto">
        <img class="img2" src="https://upload.wikimedia.org/wikipedia/fr/0/0b/Men_2021.PNG" alt="Minstere" width="100" height="auto" >
    </header>
    <article>
        <h3>Informations personnelles</h3>
        <main>
            <div><span>Nom: </span> <b>{{ $name }}</b></div>
            <div><span>Prénom: </span> <b>{{ $prenom }}</b></div>
            <div><span>Date de naissance: </span> <b>{{ $dateNs }}</b></div>
            <div><span>Lieu de naissance:</span> <b>{{ $lieuNs }}</b></div>
            <div><span>Téléphone: </span> <b>{{ $tel }}</b></div>
            <div><span>email:</span> <b>{{ $email }}</b></div>
            <div><span>cne:</span> <b>{{ $cne }}</b></div>
        </main>
    </article>
    <article>
        <h3>Informations Scolaires</h3>
        <main>
            <div><span>Formation:</span> <b>Brevet Technicien Supérieur</b></div>
            <div><span>Ville:</span> <b>Essaouira</b></div>
            <div><span>Lycée:</span> <b>Lycée Qualifiant Mohamed V</b></div>
            <div><span>Branche:</span> <b>{{ $filiere }}</b></div>
        </main>
    </article>
    <footer>
        <h4>Signature:</h4>
    </footer>
</body>

</html>
