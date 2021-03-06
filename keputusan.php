<?php
    session_start();
    if ($_SESSION["login"] == false)
        header("Location:./login.php");
    include("sambungan.php");
    include("functions.php");

    // Get all peserta
    try {
        $sql = "SELECT * FROM peserta";
        $result = mysqli_query($sambungan,$sql);
        while ($array = mysqli_fetch_array($result)) {
            $peserta[$array["id"]] = [
                "no_kp" => $array["no_kp"],
                "nama" => $array["nama"]
                ];
        }
    } catch (Exception $e) {}
    $is_peserta = isset($peserta);

    // If have registered
    if ($is_peserta) {
        try {
            // Get scores
            $sql = "SELECT * FROM scores";
            $result = mysqli_query($sambungan,$sql);
            $num_col = mysqli_num_fields($result)-1;
            while ($array = mysqli_fetch_array($result)) {
                $id = $array["id_peserta"];
                $skor = 0;
                for ($i=1;$i<$num_col+1;$i++) {
                    $r = "r$i";
                    if ($array[$r] !== "NULL") {
                        $skor = $skor + floatval($array[$r]);
                    }
                }
                $peserta_skor["$id"] = $skor;
            }
            arsort($peserta_skor);

            // Format keputusan data
            $i = 1;
            foreach (array_keys($peserta_skor) as $id) {
                $skor = $peserta_skor["$id"];
                $no_kp = $peserta["$id"]["no_kp"];
                $nama = $peserta["$id"]["nama"];
                $keputusan[] = [
                    "rank" => $i,
                    "id" => $id,
                    "no_kp" => $no_kp,
                    "nama" => $nama,
                    "skor" => $skor
                ];
                $i++;
            }
        } catch (Exception $e) {
            // Format keputusan data
            $i = 1;
            foreach ($peserta as $key => $value) {
                $skor = 0;
                $id = $key;
                $no_kp = $value["no_kp"];
                $nama = $value["nama"];
                $keputusan[] = [
                    "rank" => $i,
                    "id" => $id,
                    "no_kp" => $no_kp,
                    "nama" => $nama,
                    "skor" => $skor
                ];
                $i++;
            }
        }

        // Export keputusan
        $out = fopen("keputusan.csv", 'w');
        fputcsv($out, array_keys($keputusan[0]), ",");
        foreach ($keputusan as $row)
        {
            fputcsv($out, $row, ",");
        }
        fclose($out);
        header("download.php?file=keputusan.csv");

        $_POST = NULL;
    }
?>

<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
    <header>
        <?php 
            include("navbar_1.php");
            include("navbar_2.php");
        ?>
    </header>
    <div class="center">
        <h2>Keputusan</h2>
        <?php alert() ?>
        <form action="download.php?file=keputusan.csv" method="post">
            <table class="table table-bordered">
                <?php
                    if ($is_peserta) {
                        echo '<input type="submit" value="export" name="export">';
                        
                        // List keputusan
                        $string = <<<HEREDOC
                        <thead>
                            <tr>
                                <td style="width:10%">Kedudukan</td>
                                <td style="width:10%">Id</td>
                                <td style="width:10%">No. KP</td>
                                <td style="width:20%">Nama</td>
                                <td style="width:10%">Skor</td>
                            <tr>
                        </thead>
                        HEREDOC;
                        echo $string;
                        
                        $string = "<tbody>";
                        foreach ($keputusan as $row) {
                            $string = $string . '<tr>';
                            foreach(array_keys($row) as $key) {
                                $string = $string . '<td>' .$row["$key"] . '</td>';
                            }
                        }
                        $string = $string . "</tbody>";
                        echo $string;
                    } else {
                        echo "<div class='alert alert-warning'>Tolong daftarkan peserta.</div>";
                    }
                ?>
            </table>
        </form>
    </div>
</body>
</html>