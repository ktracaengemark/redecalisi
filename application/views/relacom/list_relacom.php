<br>

<table class="table table-hover">
    <thead>
        <tr>
            <th>RelaCom</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=0;
        if ($q) {

            foreach ($q as $row)
            {

                $url = base_url() . 'relacom/alterar/' . $row['idTab_RelaCom'];
                #$url = '';

                echo '<tr class="clickable-row" data-href="' . $url . '">';
                    echo '<td>' . $row['RelaCom'] . '</td>';
                    echo '<td></td>';
                echo '</tr>';            

                $i++;
            }
            
        }
        ?>

    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total encontrado: <?php echo $i; ?> resultado(s)</th>
        </tr>
    </tfoot>
</table>



