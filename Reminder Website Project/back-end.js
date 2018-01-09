chrome.browserAction.onClicked.addListener(function(tab){
    chrome.tabs.create({url: "http://hexatask-ca.stackstaging.com/" });
});
