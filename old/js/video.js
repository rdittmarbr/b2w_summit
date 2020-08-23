/*
Biblioteca para a execução de videos com referencia

dependencias da lib:
  <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    ATENÇÃO:
    -O Conteiner no qual o player sera carregado deve possuir um valor de
     width e height definidos que os valores de tamanho do player se baseam nesse
     container para se ajustar (configurar valores minimos ou maximos não bastam);

    */


//Controlador do player de videos com referencias
class VideoPlayerController {

    constructor(firstVideo) {
        //Lista de videos completamente conhecidos
        this.FVideos = []; //new Array.of(VideoModel);
        this.add(firstVideo);
        //Video atual sendo exibido
        this.currentVideo = firstVideo;
        //Tempo atual de execução do video
        //Pilha de fluxo de videos
        this.videoStack = [];
        //DOM do html5 <video> onde é exibido o video
        this.FPlayer = null;
        //DOM do div de lista de videos
        this.FRefList = null;
        this.backButton = null;
        this.FContainerBox = null;
    }

    //Adiciona um video a lista de videos conhecidos;
    add(video) {

        this.FVideos[video.id] = video;
        return this.FVideos[video.id];
    }


    //Carrega video no tempo 0;
    load() {
        this.FPlayer.src = this.currentVideo.FSource;
        this.FPlayer.currentTime = 0;
    }
    load(time) {
        this.FPlayer.src = this.currentVideo.FSource;
        this.FPlayer.currentTime = time;
    }
    jumpToRef(aRef) {
        //Se for uma referencia dentro do mesmo video
        if (aRef.id == this.currentVideo.id) {
            this.FPlayer.currentTime = aRef.time;
        } else { //Se a referencia for em outro video
            //Empilha video atual
            var old = this.currentVideo;
            let newStackElement = new VideoReferenceModel(old.id, null, this.FPlayer.currentTime, "", "", old.FSource);
            this.videoStack.push(newStackElement);
            this.backButton.style.visibility = "visible";
            //Testa se o video já é conhecido e atribui ao atual
            this.currentVideo = this.getVideo(aRef.id);
            this.load(aRef.time);
            this.refreshReference();
        }

    }

    backVideoRef() {
        var backRef = this.videoStack.pop();
        this.currentVideo = this.getVideo(backRef.id);
        this.load(backRef.time);
        this.refreshReference();
        if (this.videoStack && this.videoStack.length < 1) {
            this.backButton.style.visibility = "hidden";

        }
    }
    //Pega um video
    getVideo(id) {
        //Se o video já for conhecido
        if (this.FVideos[id]) {
            return this.FVideos[id];
        } else {
            //Se o video não for conhecido, faz uma requizição

            this.FVideos[id] = TcDesktop.getModule({ video: id });
        }
    }

    createVideo(container) {
        let context = this;
        //Cria primeira div dentro do container
        let c_video = createDiv({ class: "c-video" }, container);
        this.FContainerBox = c_video;
        //Botão de retorno ao video anterior
        // c_video.style.width = container.clientWidth;
        // c_video.style.height = container.clientHeight;

        this.backButton = createDiv({ class: "buttonBackDiv" }, c_video);
        var btn_back = createElement("i", { class: "fas fa-arrow-left buttons" }, this.backButton);

        this.backButton.addEventListener('click', function (event) {
            context.backVideoRef();
        });
        this.backButton.style.visibility = "hidden";
        //Cria e adiciona o <video>
        this.FPlayer = createElement("video", { class: "video", src: this.currentVideo.FSource, id: "player_" + this.currentVideo.id, controls: " " }, c_video);
        let v_controls = createDiv({ class: "v-controls", id: "v-controls" + this.currentVideo.id }, c_video);

        let buttonListShow = createDiv({ class: "buttonListShow" }, v_controls);
        createElement("i", { class: "fas fa-plus buttons" }, buttonListShow);
        let listDiv = createDiv({ class: "listDiv" }, v_controls);

        setHover(buttonListShow, function () {
            v_controls.style = "transform:translateX(0)";
        }, function () {
            v_controls.style = "transform:translateX(90%)";

        });
        setHover(listDiv, function () {
            v_controls.style = "transform:translateX(0)";
        }, function () {
            v_controls.style = "transform:translateX(90%)";

        });
        this.FRefList = listDiv;
        if (Array.isArray(this.currentVideo.FHistory) && this.currentVideo.FHistory.length > 0) {

            this.showReference(listDiv);

        } else {
            //TODO: tratar lista de refenrecia vazia
        }
        this.load(10);
    }
    hideVideo() {
        if (this.FContainerBox) {
            this.FContainerBox.style.display = "hidden";
        }
    }
    changeVisibility(mode) {
        if (this.FContainerBox) {
            if (mode) {
                this.FContainerBox.style.display = mode;
            } else {
                if (this.FContainerBox.currentStyle.visibility != "hidden") {
                    this.FContainerBox.style.visibility = "hidden";
                    this.FPlayer.pause();

                } else {
                    this.FContainerBox.style.visibility = "visible";
                }
            }

        } else {
            console.log("You need 'createVideo()' first ");
        }
    }

    refreshReference() {
        this.showReference(this.FRefList);

    }
    showReference(container) {
        clearChild(container);

        let context = this;
        let refList = this.currentVideo.FHistory;
        for (var i = 0; i < refList.length; i++) {
            let ref = refList[i];
            let actual_video = this.FVideo;

            var a = createDiv({ class: "videoItemBox" }, container);
            var b = createElement("img", { class: "videoPreview", src: ref.prevPic }, a);
            b.innerText = ref.prevPic;
            b = createDiv({ class: "videoContend" }, a);
            this
            var p = createP({ class: "videoTitle" }, b);
            p.innerText = ref.title;
            var p = createP({ class: "videoDescrption" }, b);
            p.innerText = ref.descrption;

            a.addEventListener('click', function (event) {
                context.jumpToRef(ref);
            });

        };
    }
}



class VideoModel {
    constructor(id, path, codec) {
        this.id = id;
        this.FSource = path || ""; // Vídeo
        this.FCodec = codec || ""; // Codec

        this.FSize = { // Tamanho do vídeo
            width: 0,
            height: 0
        };
        this.title = ""
        this.FPoster = ""; // Poster do video
        this.FHistory = []; // Pontos de atenção no vídeo
        this.FReopen = 0; // status do vídeo (true se já assistiu 100%)
        this.FDOM = '';
        this.FVideo = ''; //Dom Video
    }
    setContend(vTitle, vDescrption, FReopen) {
        this.title = vTitle;
        this.descrption = vDescrption;
        this.FReopen = FReopen;

    }
    setReference(videosRef) {
        this.FHistory = videosRef;
    }


};
class VideoReferenceModel {
    constructor(id, prevPic, time, title, descrption, path) {
        this.id = id;
        this.prevPic = prevPic;
        this.time = time;
        this.title = title;
        this.descrption = descrption;
        this.path = path;
    }

}
var exemplo1 = new VideoModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4", "");
exemplo1.setContend("Titulo", "Descrição", 200);
exemplo1.setReference([
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_01.png", 01, "Feira de Cursos", "2019", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4"),
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_23.png", 23, "Graciela Ines", "Vice Reitora - UFPR", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4"),
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_46.png", 46, "Eduardo barra", "Pró-Reitor de Graduação da UFPR", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4"),
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_88.png", 88, "Ivan", "Professor do Ensino Médio", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4"),
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_117.png", 101, "Processo Seletivo", "Núcleo de Concursos da UFPR", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4"),
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_140.png", 144, "Debora", "Alunos de graduação apresentam detalhes do seu curso.", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4"),
    new VideoReferenceModel("id_01", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr_170.png", 170, "Informação", "Informações sobre a Feira", "http://clibras.teste.ufpr.br/clibras/_vd/ufpr.mp4")
]);

var player1 = new VideoPlayerController(exemplo1);
