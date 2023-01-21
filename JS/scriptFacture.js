window.onload = function () {


            const date = new Date();
            const invoice = this.document.getElementById("invoice");
            const id_commande=this.document.getElementById("id_commande").innerHTML;
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: `Facture${id_commande}Du${date.toLocaleDateString()}.pdf`,
                image: { type: 'jpeg', quality: 15 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(invoice).set(opt).save();


}


