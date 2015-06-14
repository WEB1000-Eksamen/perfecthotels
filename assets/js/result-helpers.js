function fillResults (data, resultContainer, template) {
    var resultTmpl = $.templates(template),
        html = resultTmpl.render(data);
    
    resultContainer.append(html);
}

function fillResultsNoData (resultContainer, template) {
    var resultTmpl = $.templates(template),
        html = resultTmpl.render();
    
    resultContainer.append(html);
}