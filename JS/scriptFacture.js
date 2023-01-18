window.onload = function () {

            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 15 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(invoice).set(opt).save();

}