function generatepdf(){
    let div=document.querySelector(".elem");
                                let btn=document.querySelector(".download");
                                btn.addEventListener('click',() => {
                                    html2pdf().from(div).save()
    })
}