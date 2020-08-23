class FaqWindow {

    //faqContent = [faq:{icon, title, description}
    constructor(faqContent, containerID) {
        //Variaveis
        this.container = document.getElementById(containerID);
        this.faqs = faqContent;
        this.showState = false;
        //Primeiro load

        this.list = document.getElementById('faqList');
        var context = this;
        let button = document.getElementById('faqButton');

        button.addEventListener('click', function (event) {
            context.showState = !(context.showState);
            let btn = document.getElementById("faqButtonP");
            if (context.showState) {
                btn.classList.remove("closed");
                context.container.classList.add("show");
            } else {
                btn.classList.add("closed");

                context.container.classList.remove("show");
            }

        });


    }
    refreshFaq(faqList) {
        clearChild(this.list);
        this.faqs = faqList;
        for (var i = 0; i < faqList.length; i++) {
            let item = faqList[i];

            let box = createDiv({ class: "faqItemBox" }, this.list);
            let icone = createElement("img", { class: "faqPreview", src: item.icon }, box);
            let contend = createDiv({ class: "faqContend" }, box);
            var p = createP({ class: "faqTitle" }, contend);
            p.innerText = item.question;
            var p = createP({ class: "faqDescription" }, contend);
            p.innerText = item.description;

            box.addEventListener('click', item.handleItemClick);

        };
    }
}

class faqModel {
    constructor(icon, question, description, handleItemClick) {
        this.icon = icon;
        this.question = question;
        this.description = description;
        this.handleItemClick = handleItemClick;

    }
}
