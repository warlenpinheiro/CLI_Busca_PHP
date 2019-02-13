<?php

	$filename = "employers_list.csv";
	try {
		if(file_exists($filename) && is_readable($filename)){
			$fh = fopen($filename, "r");
			while (($line = fgetcsv($fh)) !== false){
			  $meuArray[] = $line;
			}
			fwrite(STDOUT, "Digite um nome ou cargo:");
			$name = fgets(STDIN);
			$name = trim(ucwords($name));
			$chave = "/(?i){$name}/";
			$contador = 0;

			foreach ($meuArray as $collection) {
				if (preg_match($chave, $collection[0]." ".$collection[1]) or preg_match($chave, $collection[3])) {
					$result = array_combine($meuArray[0], $collection);
					print_r($result);
					echo "\n";
					$contador++;
				}
			}
			if ($contador==0) {
				fwrite(STDOUT, "Nenhum dado encontrado!");
			}
			fclose($fh);
			exit(0);
		}else{
			throw new Exception("Nao foi possivel ler os dados", 1);
		}
	} catch (Exception $e) {
		fwrite(STDOUT, $e->getMessage());
		exit(1);
	}
