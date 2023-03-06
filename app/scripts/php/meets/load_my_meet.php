<?php

    foreach ($result_myMeets as $key) {

        $myMeets .= '
            <div id="meet_form" class="section" style="margin-top: 2em; width: 800px;">
                <div class="meet-form">
                    <form action="app/scripts/php/meets/update_meet.php" method="post" autocomplete="off">
                        <input type="hidden" name="meet_id" value="'.$key['meet_id'].'">
                        <input type="text" name="title" id="title" placeholder="Název srazu" value="'.$key['title'].'" required>

                        <table>
                            <tr>
                                <th><label for="datetime"><i class="fa-regular fa-calendar-days"></i> Datum a čas</label></th>
                                <th><label for="gps_location"><i class="fa-solid fa-location-arrow"></i> GPS souřadnice</label></th>
                            </tr>
                            <tr>
                                <td><input type="datetime-local" name="datetime" id="datetime" value="'.$key['datetime'].'"></td>
                                <td><input type="text" name="gps_location" id="gps_location" placeholder="volitelné, usnadňuje však nalezení" value="'.$key['gps_location'].'"></td>
                            </tr>
                        </table>
                    
                        <table>
                            <tr>
                                <th><label for="town"><i class="fa-solid fa-city"></i> Město</label></th>
                                <th><label for="address"><i class="fa-solid fa-street-view"></i> Ulice a čp.</label></th>
                            </tr>
                            <tr>
                                <td><input type="text" name="town" id="town" placeholder="Rockport" value="'.$key['town'].'" required></td>
                                <td><input type="text" name="address" id="address" placeholder="Downtown 210" value="'.$key['address'].'" required></td>
                            </tr>
                        </table>
                            
                        <label for="description">Krátký popis srazu</label>
                        <textarea name="description" id="description">'.nl2br($key['description']).'</textarea>

                        <input type="submit" value="Uložit změny">
                        <input type="hidden" name="meet_hash" value="'.$key['meet_hash'].'">
                    </form>
                </div>
            </div>'
        ; 
    }
?>