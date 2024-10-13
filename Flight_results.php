<?php include_once 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Results - AreoBook</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f4f8;
        }

        main {
            padding: 40px 20px;
            background-color: #f0f4f8;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
            letter-spacing: 1.5px;
        }

        .success-message {
            text-align: center;
            color: #28a745;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .flight-card {
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .flight-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .flight-card h3 {
            font-size: 20px;
            color: #2d72d9;
            margin-bottom: 8px;
        }

        .flight-card p {
            font-size: 14px;
            margin: 8px 0;
            color: #666;
        }

        .price {
            font-size: 16px;
            color: #ff5e57;
            font-weight: bold;
        }

        .book-now-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease;
        }

        .book-now-btn:hover {
            background-color: #218838;
        }

        /* Responsive styles */
        @media (max-width: 1024px) {
            .results-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .results-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .results-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <main>
        <h1>Flight Results</h1>

        <div class="results-grid" id="resultsGrid"></div>
    </main>

    <script>
        const flights = [{
                flightNumber: 101,
                origin: 'New York',
                destination: 'London',
                price: '500'
            },
            {
                flightNumber: 102,
                origin: 'San Francisco',
                destination: 'Tokyo',
                price: '700'
            },
            {
                flightNumber: 103,
                origin: 'Los Angeles',
                destination: 'Paris',
                price: '650'
            },
            {
                flightNumber: 104,
                origin: 'Chicago',
                destination: 'Dubai',
                price: '800'
            },
            {
                flightNumber: 105,
                origin: 'Miami',
                destination: 'Rome',
                price: '550'
            },
            {
                flightNumber: 106,
                origin: 'Boston',
                destination: 'Berlin',
                price: '600'
            },
            {
                flightNumber: 107,
                origin: 'Houston',
                destination: 'Madrid',
                price: '580'
            },
            {
                flightNumber: 108,
                origin: 'Seattle',
                destination: 'Sydney',
                price: '950'
            },
            {
                flightNumber: 109,
                origin: 'Atlanta',
                destination: 'Amsterdam',
                price: '620'
            },
            {
                flightNumber: 110,
                origin: 'Denver',
                destination: 'Barcelona',
                price: '570'
            },
            {
                flightNumber: 111,
                origin: 'Las Vegas',
                destination: 'Hong Kong',
                price: '900'
            },
            {
                flightNumber: 112,
                origin: 'Orlando',
                destination: 'Melbourne',
                price: '990'
            },
        ];

        function displayFlights() {
            const resultsGrid = document.getElementById('resultsGrid');

            flights.forEach(flight => {
                const flightCard = document.createElement('div');
                flightCard.classList.add('flight-card');

                flightCard.innerHTML = `
                    <h3>Flight: ${flight.flightNumber}</h3>
                    <p>Origin: ${flight.origin}</p>
                    <p>Destination: ${flight.destination}</p>
                    <p class="price">Price: ${flight.price}</p>
                    <form method="post" class="booking-form">
                        <input type="hidden" name="flightNumber" value="${flight.flightNumber}">
                        <input type="hidden" name="origin" value="${flight.origin}">
                        <input type="hidden" name="destination" value="${flight.destination}">
                        <input type="hidden" name="price" value="${flight.price}">
                        <button type="button" class="book-now-btn" onclick="bookFlight(this)">Book Now</button>
                    </form>
                `;

                resultsGrid.appendChild(flightCard);
            });
        }

        function bookFlight(button) {
            const form = button.parentNode;


            const formData = new FormData(form);


            fetch('book_flight.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data === 'success') {
                        alert('Booking successful!');
                        button.textContent = 'Booked!';
                        button.disabled = true;
                        button.style.backgroundColor = "#ccc";
                    } else {
                        alert('Failed to book flight.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while booking.');
                });
        }

        displayFlights();
    </script>

</body>

</html>

<?php include_once 'footer.php'; ?>