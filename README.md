
       ,---,                                                .--.--.     ,---,                         
    ,`--.' |                                               /  /    '. ,--.' |              ,-.----.   
    |   :  :                                              |  :  /`. / |  |  :       ,---.  \    /  \  
    :   |  '  .--.--.                                     ;  |  |--`  :  :  :      '   ,'\ |   :    | 
    |   :  | /  /    '    ,--.--.      ,--.--.     ,---.  |  :  ;_    :  |  |,--. /   /   ||   | .\ : 
    '   '  ;|  :  /`./   /       \    /       \   /     \  \  \    `. |  :  '   |.   ; ,. :.   : |: | 
    |   |  ||  :  ;_    .--.  .-. |  .--.  .-. | /    / '   `----.   \|  |   /' :'   | |: :|   |  \ : 
    '   :  ; \  \    `.  \__\/: . .   \__\/: . ..    ' /    __ \  \  |'  :  | | |'   | .; :|   : .  | 
    |   |  '  `----.   \ ," .--.; |   ," .--.; |'   ; :__  /  /`--'  /|  |  ' | :|   :    |:     |`-' 
    '   :  | /  /`--'  //  /  ,.  |  /  /  ,.  |'   | '.'|'--'.     / |  :  :_:,' \   \  / :   : :    
    ;   |.' '--'.     /;  :   .'   \;  :   .'   \   :    :  `--'---'  |  | ,'      `----'  |   | :    
    '---'     `--'---' |  ,     .-./|  ,     .-./\   \  /             `--''                `---'.|    
                        `--`---'     `--`---'     `----'                                     `---`    

Hi there! Welcome to Isaac Shop!

## Get started

1. Execute composer to get all dependencies : `sh composer.sh update`
2. Get yaml configurations from the database : `php vendor/bin/doctrine orm:convert-mapping --namespace="" --force --from-database yml ./config/yaml`
3. Create the models from yaml configurations : `php vendor/bin/doctrine orm:generate-entities --generate-annotations=false --update-entities=true --generate-methods=false ./model`
4. Update your doctrine dependencies : `sh composer.sh update`
5. Validate your schema : `php vendor/bin/doctrine orm:validate-schema`

And that's all there is to it! Just have fun. Go ahead and visit the website. It's all up to you! 

Admin acount : 
* login : `admin` 
* password : `*Admin123*`
