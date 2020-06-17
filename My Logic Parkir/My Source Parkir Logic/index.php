<?php
require 'db/connection.php';

$data = array();


if ($result=$db->query("SELECT * FROM biaya"))
{
	if ($result->num_rows)
	{
		while($rows=$result->fetch_object())
		{
			$biayaMobil = $rows->biayaMobil;
			$biayaMotor = $rows->biayaMotor;
			$biayaBusTruk = $rows->biayaBusTruk;
			$biayaLainnya = $rows->biayaLainnya;
		}
	}
	$result->free();
}

//=========Masukan==========

if (!empty($_POST))
{
	if (isset($_POST['keluarID']))
	{
		$keluar = trim($_POST['keluarID']);
		echo $keluar;
		$db->query("UPDATE parkir SET waktuKeluar = now() WHERE noPolisi='{$keluar}'");
		$db->query("UPDATE parkir SET biayaTotal=((waktuKeluar-waktuParkir)*biayaperJam)/3600 WHERE noPolisi='{$keluar}'");
		$db->query("UPDATE parkir SET status=0 WHERE noPolisi='{$keluar}'");
		header('Location:index.php');
		die();
	}

	if (isset($_POST['hapusID'])) {
		$hapus = trim($_POST['hapusID']);
		$db->query("DELETE FROM parkir WHERE noPolisi ='{$hapus}'");
		header('Location:index.php');
		die();
	}

	if (isset($_POST['biayaMobil'],$_POST['biayaMotor'],$_POST['biayaBusTruk'],$_POST['biayaLainnya']))
	{
		$db->query("UPDATE biaya SET biayaMobil = {$_POST['biayaMobil']}, biayaMotor = {$_POST['biayaMotor']}, biayaBusTruk = {$_POST['biayaBusTruk']}, biayaLainnya = {$_POST['biayaLainnya']}");

		header('Location:index.php');
        die();
	}

    if(isset($_POST['noPolisi'],$_POST['kendaraan'],$_POST['barangLainnya']))
    {
        $noPolisi = trim($_POST['noPolisi']);
        $kendaraan = trim($_POST['kendaraan']);
        $barangLainnya = trim($_POST['barangLainnya']);
	        if ($kendaraan == "Mobil")
	        {
	        	$biaya = $biayaMobil;
	        }
	        else if ($kendaraan == "Motor")
	        {
	        	$biaya = $biayaMotor;
	        }
	        else if ($kendaraan == "Motor")
	        {
	        	$biaya = $biayaBusTruk;
	        }
	        else
	        {
	        	$biaya = $biayaLainnya;
	        }


        if (!empty($noPolisi) && !empty($kendaraan))
        {
            $insert=$db->prepare("INSERT INTO parkir(noPolisi, kendaraan, barangLainnya, biayaperJam, waktuParkir) VALUES(?,?,?,?,now())");
            $insert->bind_param('sssi',$noPolisi,$kendaraan,$barangLainnya,$biaya);

            if($insert->execute())
            {
                header('Location:index.php');
                die();
            }
        }
    }
}

//==========================

if ($result = $db->query("SELECT * FROM parkir"))
{
	if ($result->num_rows)
	{
		while($rows=$result->fetch_object())
		{
			$data[]=$rows;
		}
		$result->free();
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title> Parkiran Online </title>
	</head>
	<body>
		<table border="1">
			<tr>
				<th> No Polisi </th>
				<th> Kendaraan </th>
				<th> Barang Lainnya </th>
				<th> Biaya perJam </th>
				<th> Waktu Parkir </th>
				<th> Waktu Keluar </th>
				<th> Biaya Total </th>
			</tr>
			<?php if (!count($data))
			{
				echo "<td colspan='7'>Data Kosong</td>";
			}
			else
			{
				foreach($data as $value)
				{
			?>
			<tr>
				<td> <?php echo ($value->noPolisi) ?> </td>
				<td> <?php echo ($value->kendaraan) ?> </td>
				<td> <?php echo ($value->barangLainnya) ?> </td>
				<td><form method="POST" action=""><input type="number" name="biayaperJamIn" <?php echo "value='",($value->biayaperJam),"'"; ?>></form>  </td>
				<td> <?php echo ($value->waktuParkir) ?> </td>
				<td> <?php echo ($value->waktuKeluar) ?> </td>
				<td> <?php echo "Rp",($value->biayaTotal) ?> </td>
				<td>
					<form method = "POST" action="">
						<?php if ($value->status == 1): ?>
							<input type="text" name="keluarID" hidden="on"<?php echo "value='",$value->noPolisi,"'" ?>>
							<input type="submit" name="keluar" value="keluar">
						<?php else: ?>
							<input type="text" name="hapusID" hidden="on"<?php echo "value='",$value->noPolisi,"'" ?>>
							<input type="submit" name="hapus" value="hapus">
						<?php endif; ?>
					</form>
				</td>
			</tr>
		<?php
				}
			} ?>
		</table>
		<hr>
		<table style="width:1000px">
			<tr>
				<td>
					<table style="width:400">
						<form method="Post" action="">
							<tr>
								<th style="text-align: left;"><strong>Masukan Data :</strong></th>
							</tr>
							<tr>
								<div>
									<td><label for="noPolisi"> No Polisi </label></td>
									<td><input type="text" name="noPolisi" id="noPolisi" placeholder="(tanpa spasi) ex: AA1234TP"><br></td>
								</div>
							</tr>
							<tr>
								<div>
									<td><label for="kendaraan"> Kendaraan </label><br></td>
									<td><input type="radio" name="kendaraan" id="kendaraan" value="Mobil">Mobil</td></tr>
									<tr><td>&nbsp;</td><td><input type="radio" name="kendaraan" id="kendaraan" value="Motor">Motor</td></tr>
									<tr><td>&nbsp;</td><td><input type="radio" name="kendaraan" id="kendaraan" value="Bus/Truk">Bus/Truk</td></tr>
									<tr><td>&nbsp;</td><td><input type="radio" name="kendaraan" id="kendaraan" value="Lainnya">Lainnya</td></tr>
								</div>
							<tr>
								<div>
									<td><label for="barangLainnya"> Barang Lainnya </label></td>
									<td><textarea name="barangLainnya" id="barangLainnya" placeholder="ex: Helm(1), Jaket(1),dll"></textarea><br></td>
								</div>
							</tr>
							<tr>
								<td><input type="submit" name="masukan" value="Masukan"></td>
							</tr>
						</form>
					</table>
				</td>
				<td>
					<table>
						<form method="Post" action="">
						<tr>
							<th style="text-align: left;" colspan="2">Biaya perJam :</strong></th>
						</tr>
						<tr>
							<div>
								<td><label for="biayaMobil"> Mobil </label></td>
								<td><input style = "width: 80px" type="number" name="biayaMobil" id="biayaMobil" <?php echo "placeholder='",$biayaMobil,"'"; ?><br></td>
							</div>
						</tr>
						<tr>
							<div>
								<td><label for="biayaMotor"> Motor </label></td>
								<td><input style = "width: 80px" type="number" name="biayaMotor" id="biayaMotor" <?php echo "placeholder='",$biayaMotor,"'"; ?><br></td>
							</div>
						</tr>
						<tr>
							<div>
								<td><label for="biayaBusTruk"> biayaBusTruk </label></td>
								<td><input  style = "width: 80px" type="number" name="biayaBusTruk" id="biayaBusTruk" <?php echo "placeholder='",$biayaBusTruk,"'"; ?><br></td>
							</div>
						</tr>
						<tr>
							<div>
								<td><label for="biayaLainnya"> biayaLainnya </label></td>
								<td><input style = "width: 80px" type="number" name="biayaLainnya" id="biayaLainnya" <?php echo "placeholder='",$biayaLainnya,"'"; ?><br></td>
							</div>
						</tr>
						<tr>
							<td><input type="submit" name="ganti" value="Ganti"></td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
