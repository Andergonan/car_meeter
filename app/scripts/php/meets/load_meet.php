<?php
    $meets="";
    $mysql = "SELECT meet_id, organizer, title, organizing, car_specs, datetime, town, address, place, gps_location, description FROM meets";
    $result = $conn->query($mysql);
    $conn->close();

    foreach ($result as $key) {
        $meets .= '
            <div class="section">
                <div class="meets-table-container">   
                    <div id="title"><h2>'.$key['title'].'</h2></div>
                    <table>
                        <tr>
                            <th><i class="fa-solid fa-car"></i> Specifikace</th>
                            <th><i class="fa-regular fa-calendar-days"></i> Sraz je</th>
                        <tr>
                            <td>'.$key['car_specs'].'</td>
                            <td>'.$key['datetime'].'</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th><i class="'.$key['place'].'"></i> Adresa</th>
                            <th><i class="fa-solid fa-location-arrow"></i> GPS souřadnice</th>
                        </tr>
                        <tr>
                            <td>'.$key['town'].': '.$key['address'].'</td>
                            <td>'.$key['gps_location'].'</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th>Popis</th>
                        </tr>
                        <tr>
                            <td><p>'.nl2br($key['description']).'</p></td>
                        </tr>
                    </table>
                    <p><i class="fa-solid fa-id-card"></i> Pořadetel: '.$key['organizer'].'</p>
                    <p id="organizing"><i class="'.$key['organizing'].'"></i></p>
                    <form class="meet-actions" action="app/scripts/php/meets/add_to_party.php" method="post">
                        <input type="hidden" name="meet_id" value="'.$key['meet_id'].'">
                        <button type="submit"><i class="fa-solid fa-wheelchair-move"></i> Zúčastnit se</button>
                    </form>
                    <form class="meet-actions" action="app/scripts/php/meets/leave_party.php" method="post">
                        <input type="hidden" name="meet_id" value="'.$key['meet_id'].'">
                        <button type="submit"><i class="fa-solid fa-user-xmark"></i> Zrušit účast</button>
                    </form>
                </div>
            </div>'
        ; 
    }
?>