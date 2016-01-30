 function extraiScript(texto){  
     var ini, pos_src, fim, codigo, texto_pesquisa;  
     var objScript = null;    
     texto_pesquisa = texto.toLowerCase()    
     ini = texto_pesquisa.indexOf('<script', 0)   
     while (ini!=-1){   
         var objScript = document.createElement("script");    
         pos_src = texto_pesquisa.indexOf(' src', ini)    
         ini = texto_pesquisa.indexOf('>', ini) + 1;    
         if (pos_src < ini && pos_src >=0){
             ini = pos_src + 4;  
             fim = texto_pesquisa.indexOf('.', ini)+4;  
             codigo = texto.substring(ini,fim);  
             codigo = codigo.replace("=","").replace(" ","").replace("\"","").replace("\"","").replace("\'","").replace("\'","").replace(">","");    
             objScript.src = codigo;  
         }else{
             fim = texto_pesquisa.indexOf('</script>', ini);    
             codigo = texto.substring(ini,fim);    
             objScript.text = codigo;  
         }    
         document.body.appendChild(objScript);   
         ini = texto.indexOf('<script', fim);    
         objScript = null;  
     }  
 } 

function returnQuery(form){
    var elements = form.elements;
    var fields = null;
    for (var i = 0; i < elements.length; i++) {
        if ((name = elements[i].name) && (value = elements[i].value)){
                    if(i == 0){
                        fields = name + "=" + encodeURIComponent(value);
                    } else {
                                    fields += "&"+(name + "=" + encodeURIComponent(value));
                    }
                }
    }
    //alert (fields);
    return fields;
}

function count()
{
    if(document.getElementById("time").innerHTML != 0)
    {
        document.getElementById("time").innerHTML = document.getElementById("time").innerHTML - 1;
        setTimeout("count()", 1500);
    }
    else
    {
        window.location = '?';
    }
}

function Form(idForm) {  
    var elementosFormulario = document.getElementById(idForm).elements;  
    var qtdElementos = elementosFormulario.length;  
     var queryString = "";  
     var elemento;  
    this.ConcatenaElemento = function(nome,valor) {   
                                 if (queryString.length>0) {   
                                     queryString += "&";  
                                 }  
                                 queryString += encodeURIComponent(nome) + "=" + encodeURIComponent(valor);  
                              };  
     for (var i=0; i<qtdElementos; i++) {   
         elemento = elementosFormulario[i];  
         if (!elemento.disabled) {   
             switch(elemento.type) {   
                 case 'text': case 'password': case 'hidden': case 'textarea':   
                     this.ConcatenaElemento(elemento.name,elemento.value);  
                     break;  
                 case 'select-one':  
                     if (elemento.selectedIndex>=0) {  
                         this.ConcatenaElemento(elemento.name,elemento.options[elemento.selectedIndex].value);  
                     }  
                     break;  
                 case 'select-multiple':  
                     for (var j=0; j<elemento.options.length; j++) {  
                         if (elemento.options[j].selected) {  
                             this.ConcatenaElemento(elemento.name,elemento.options[j].value);  
                         }  
                     }  
                     break;  
                 case 'checkbox': case 'radio':  
                     if (elemento.checked) {  
                         this.ConcatenaElemento(elemento.name,elemento.value);  
                     }  
                     break;  
             }  
         }  
     }
     return queryString;  
 }

function Load(url, div, tipo, campos)
{
    var ajax = null;
    if(window.ActiveXObject)
        ajax = new ActiveXObject('Microsoft.XMLHTTP');
    else if(window.XMLHttpRequest)
        ajax = new XMLHttpRequest();    
   
    if(ajax != null)
    {
        var cache = new Date().getTime();
        ajax.open(tipo, url + "&cache=" + cache , true);
        ajax.onreadystatechange = function status()
        {
            
            if(ajax.readyState == 4)
            {
                if(ajax.status == 200)
                {
                    document.getElementById(div).innerHTML = ajax.responseText;
                    var texto=unescape(ajax.responseText);
                    extraiScript(texto);
                }
            }
            else if(ajax.readyState == 0)
                document.getElementById(div).innerHTML = '<div class="ui active centered small inline loader"></div';
            else if(ajax.readyState == 4)
                document.getElementById(div).innerHTML = '<div class="ui active centered small inline loader"></div';
            else
                document.getElementById(div).innerHTML = '<div class="ui active centered small inline loader"></div';
        }
    
        if(tipo == "POST")
        {
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
            ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
            ajax.setRequestHeader("Pragma", "no-cache");
            ajax.send(campos); 
        }
        else 
        {
            ajax.send(null);
        }
    }
}
function Open(pagina)
{
    Load(pagina, "content", "GET");
}

var req;

function validarDados(campo, valor) 
{
    if(window.XMLHttpRequest) 
    {
        req = new XMLHttpRequest();
    }
    // Internet Explorer
    else if(window.ActiveXObject) 
    {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "modules/classes/validate.php?campo="+campo+"&valor="+valor+"&email="+email;
    req.open("Get", url, true); 
    req.onreadystatechange = function() 
    {
        if(req.readyState == 1) 
        {
                document.getElementById('campo_' + campo + '').innerHTML = '<font color="gray">Verificando...</font>';
        }
        if(req.readyState == 4 && req.status == 200) {   
                var resposta = req.responseText;
                document.getElementById('campo_'+ campo +'').innerHTML = resposta;
        }
    }
    req.send(null);
}
function validarDadosDois(campo, valor, email) 
{
    if(window.XMLHttpRequest) 
    {
        req = new XMLHttpRequest();
    }

    else if(window.ActiveXObject) 
    {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = "modules/classes/validate.php?campo="+campo+"&valor="+valor+"&email="+email;
    req.open("Get", url, true); 
    req.onreadystatechange = function() 
    {
            if(req.readyState == 1) 
            {
                document.getElementById('campo_' + campo + '').innerHTML = '<font color="gray">Verificando...</font>';
            }
            if(req.readyState == 4 && req.status == 200) 
            {
                var resposta = req.responseText;
                document.getElementById('campo_'+ campo +'').innerHTML = resposta;
            }
    }
    req.send(null);        
}