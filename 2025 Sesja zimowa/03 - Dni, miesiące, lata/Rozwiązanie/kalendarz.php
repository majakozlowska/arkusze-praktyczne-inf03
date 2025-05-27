<?php
$conn = mysqli_connect("localhost", "root", "", "kalendarz");
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Kalendarz</title>
        <link rel="stylesheet" href="styl.css">
    </head>
    <body>
        <header>
            <h1>Dni, miesiące, lata...</h1>
        </header>

        <section>
            <p>
                <?php
                $daysOfTheWeek = ['niedziela','poniedziałek','wtorek','środa','czwartek','piątek','sobota'];
                $currentDay = $daysOfTheWeek[date('w')];
                $today = date("m-d");
                $fullDate = date("d-m-Y");
                $query = mysqli_query($conn, "SELECT imiona FROM imieniny WHERE data = '$today'");
                $result = mysqli_fetch_assoc($query);
                echo "Dzisiaj jest " . $currentDay . ", " . $fullDate . " imieniny: " . $result['imiona'];
                ?>
            </p>
        </section>

        <aside>
            <table>
                <tr>
                    <th>liczba dni</th>
                    <th>miesiąc</th>
                </tr>
                <tr>
                    <td rowspan="7">31</td>
                    <td>styczeń</td>
                </tr>
                <tr>
                    <td>marzec</td>
                </tr>
                <tr>
                    <td>maj</td>
                </tr>
                <tr>
                    <td>lipiec</td>
                </tr>
                <tr>
                    <td>sierpień</td>
                </tr>
                <tr>
                    <td>październik</td>
                </tr>
                <tr>
                    <td>grudzień</td>
                </tr>
                <tr>
                    <td rowspan="4">30</td>
                    <td>kwiecień</td>
                </tr>
                <tr>
                    <td>czerwiec</td>
                </tr>
                <tr>
                    <td>wrzesień</td>
                </tr>
                <tr>
                    <td>listopad</td>
                </tr>
                <tr>
                    <td>28 lub 29</td>
                    <td>luty</td>
                </tr>
            </table>
        </aside>

        <main>
            <h2>Sprawdź kto ma urodziny</h2>

            <form method="POST">
                <input type="date" min="2024-01-01" max="2024-12-31" name="date" required>
                <button type="submit">Wyślij</button>
            </form>

            <?php
            if (isset($_POST['date']) && !empty($_POST['date']))
            {
                $dateInput = $_POST['date'];
                $date = date("m-d", strtotime($dateInput));
                $query = mysqli_query($conn, "SELECT imiona FROM imieniny WHERE data = '$date'");
                $result = mysqli_fetch_assoc($query);
                echo "Dnia " . date("Y-m-d", strtotime($dateInput)) . " są imieniny: " . $result['imiona'];
            }
            ?>
        </main>

        <article>
            <a href="https://pl.wikipedia.org/wiki/Kalendarz_Majów" target="_blank">
                <img src="kalendarz.gif" alt="Kalendarz Majów">
            </a>

            <h2>Rodzaje kalendarzy</h2>

            <ol>
                <li>
                    słoneczny
                    <ul>
                        <li>kalendarz Majów</li>
                        <li>juliański</li>
                        <li>gregoriański</li>
                    </ul>
                </li>
                <li>
                    księżycowy
                    <ul>
                        <li>starogrecki</li>
                        <li>babiloński</li>
                    </ul>
                </li>
            </ol>
        </article>

        <footer>
            <p>Stronę opracował(a): 00000000000</p>
        </footer>
    </body>
</html>

<?php
mysqli_close($conn);
?>