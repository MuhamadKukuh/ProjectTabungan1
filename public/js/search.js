function hapusMurid(){
			alert('Apakah Kamu Yakin Ingin Menghapus Siswa?');
		}
		
function cariSiswa(){
			var input = document.getElementById("cari");
			var filter = input.value.toLowerCase();
			var ul = document.getElementById("daftarSiswa");
			var li = document.querySelectorAll("tr")
			console.log(li)
			for(var i = 0; i<li.length; i++){
				var ahref = document.querySelectorAll("tr")[i];
				if(ahref.innerHTML.toLowerCase().indexOf(filter) > -1){
					li[i].style.display = "";
				}else{
					li[i].style.display = "none";
				}
			}
		}