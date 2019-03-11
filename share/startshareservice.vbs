DIM objShell 
do
    'set objShell=wscript.createObject("wscript.shell")
    'iReturn=objShell.Run("sharewebwork.bat", 1, TRUE)
    'msgbox iReturn
    Set oFso = CreateObject("Scripting.FileSystemObject")    
    Set oFolder = oFso.GetFolder("randomfiles")    
        
    Set oFiles = oFolder.Files    
    For Each oFile In oFiles   
        'msgbox DateDiff("n", Now, oFile.DateCreated)
	If DateDiff("d", oFile.DateCreated, Now) > 10 Then oFile.Delete
    Next  
    wscript.sleep 3000
loop 