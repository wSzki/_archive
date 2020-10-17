


[04.03.2020]

[LIQUID CHEAT SHEET](https://www.shopify.com/partners/shopify-cheat-sheet)

[]

[30 plugins in one](https://apps.shopify.com/window-shoppers?ot=7ba67be4-5880-448d-81b7-2b4b8cdae183&surface_detail=preorder&surface_inter_position=1&surface_intra_position=3&surface_type=search_ad)


# HOW TO CREATE A DEVELOPMENT STORE SHOPIFY

https://help.shopify.com/en/partners/dashboard/development-stores?itcat=partner_dashboard&itterm=recommendation

# HOW TO INSTALL AND EDIT A SHOPFY THEME

## 1. Download & install Themekit

[VIDEO TUTORIAL](https://www.youtube.com/redirect?q=https%3A%2F%2Fshopify.github.io%2Fthemekit%2F&event=video_description&v=78N7hRwIZO4&redir_token=1EY5xFEEC5O5jJgbt27s5zDv2qp8MTU4MzQwNTI5MkAxNTgzMzE4ODky)



#### MACOS
`brew tap shopify/shopify`

`brew install themekit`

#### WINDOWS [CHOCOLATEY]

`choco install themekit`


#### LINUX 

`curl -s https://shopify.github.io/themekit/scripts/install.py | sudo python`

OR (ARCH LINUX)

`yay -S shopify-themekit-bin`

## 2. Create an API Access point

Go to Shopify Dashboard
    > Apps 
      > Manage Private App
        > Generate API credentials

        Change read & write permissions


#### In Terminal

`cd`  
`mkdir [NAME OF YOUR FOLDER]`  
`theme configure -p=[INSERT API KEY FROM LAST STEP] -s=[NomDeDomaine.myshopify.com]`  

Optional = use theme ID  
`theme configure -p=[INSERT API KEY FROM LAST STEP] -s=[NomDeDomaine.myshopify.com] --themeid=[THEME ID]`  
`theme download`






