<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Sièges - Salle de Cinéma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .cinema-container {
            width: 90%;
            max-width: 1200px;
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Ajoute la possibilité de faire défiler */
            max-height: 90vh; /* Limite la hauteur du conteneur pour être plus mobile friendly */
        }

        h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .seat-map {
            display: grid;
            grid-template-columns: repeat(15, 1fr); /* 15 sièges par rangée */
            grid-gap: 5px; /* Réduit l'espace entre les sièges */
            margin-bottom: 30px;
            overflow-y: auto; /* Permet de faire défiler les sièges verticalement */
            max-height: 60vh; /* Permet aux sièges de défiler sans dépasser */
        }

        .seat {
            width: 30px; /* Réduit la taille des sièges */
            height: 30px; /* Réduit la taille des sièges */
            background-color: #3498db;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem; /* Taille du texte plus petite */
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .seat:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
        }

        .seat.selected {
            background-color: #2ecc71;
        }

        .seat.reserved {
            background-color: #e74c3c;
            cursor: not-allowed;
        }

        .form-container {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #selectedSeatsContainer {
            margin-top: 20px;
            text-align: left;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
        }

        button {
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #1e5798;
        }

        /* Media query pour les petits écrans */
        @media (max-width: 600px) {
            .seat-map {
                grid-template-columns: repeat(10, 1fr); /* Réduit les colonnes pour les petits écrans */
            }

            .seat {
                width: 25px;
                height: 25px;
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
<div class="cinema-container">
    <h2>Réservez vos sièges</h2>

    <div class="seat-map" id="seatMap">
        <!-- Les sièges seront générés ici -->
    </div>

    <div id="selectedSeatsContainer">
        <p><strong>Sièges sélectionnés :</strong></p>
        <ul id="selectedSeatsList"></ul>
    </div>

    <div class="form-container">
        <form id="reservationForm">
            <input type="text" id="name" class="form-control" placeholder="Votre nom" required>
            <input type="email" id="email" class="form-control" placeholder="Votre email" required>
            <button type="submit">Réserver</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const seatMap = document.getElementById('seatMap');
        const selectedSeats = [];
        const selectedSeatsList = document.getElementById('selectedSeatsList');

        // Total des sièges : 133 sièges
        const rows = 9;  // 9 rangées de 15 sièges (pour un total de 135 sièges)
        const seatsPerRow = 15;

        // Créer les sièges dans le conteneur
        let seatNumber = 1;
        for (let i = 0; i < rows; i++) {
            for (let j = 0; j < seatsPerRow; j++) {
                const seatElement = document.createElement('div');
                seatElement.classList.add('seat');
                seatElement.textContent = seatNumber; // Afficher le numéro du siège
                seatElement.dataset.seat = seatNumber;
                seatElement.addEventListener('click', seatClickHandler);
                seatMap.appendChild(seatElement);
                seatNumber++;
            }
        }

        // Fonction pour gérer le clic sur un siège
        function seatClickHandler(event) {
            const seatElement = event.target;
            seatElement.classList.toggle('selected');
            const seatId = seatElement.dataset.seat;

            // Ajouter ou retirer le siège de la liste sélectionnée
            if (seatElement.classList.contains('selected')) {
                selectedSeats.push(seatId);
            } else {
                const index = selectedSeats.indexOf(seatId);
                if (index > -1) {
                    selectedSeats.splice(index, 1);
                }
            }
            updateSelectedSeats();
        }

        // Mettre à jour la liste des sièges sélectionnés
        function updateSelectedSeats() {
            selectedSeatsList.innerHTML = '';
            selectedSeats.forEach(seat => {
                const listItem = document.createElement('li');
                listItem.textContent = `Siège ${seat}`;
                selectedSeatsList.appendChild(listItem);
            });
        }

        // Gérer la soumission du formulaire
        const reservationForm = document.getElementById('reservationForm');
        reservationForm.addEventListener('submit', function (event) {
            event.preventDefault();

            // Simuler l'envoi des données
            alert(`Réservation réussie pour les sièges : ${selectedSeats.join(', ')}`);

            // Réinitialiser la sélection
            selectedSeats.length = 0;
            updateSelectedSeats();

            const seats = document.querySelectorAll('.seat');
            seats.forEach(seat => seat.classList.remove('selected'));
        });
    });
</script>
</body>
</html>





<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $seats = $_POST['seats']; // Les sièges sélectionnés

    $req = $bdd->prepare("INSERT INTO reservations (name, email, seats) VALUES (:name, :email, :seats)");
    $req->execute(array(
        'name' => $name,
        'email' => $email,
        'seats' => $seats
    ));

    echo 'Réservation enregistrée !';
}
?>

