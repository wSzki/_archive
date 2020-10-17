:set nu
:syntax on
:set autoindent
:set mouse=a
:set cindent
:set linebreak

execute pathogen#infect()
"autocmd vimenter * NERDTree   
"autolaunch nerdree
"map <C-t> :NERDTreeToggle<CR>

filetype plugin on
colorscheme gruvbox

let g:gruvbox_contrast_dark='hard'
let g:airline_theme='gruvbox'
set background=dark

set incsearch
set hlsearch
set ruler
set cursorline
" surbrillance du terme recherché

set ignorecase
" recherche en rotation (on revient au début du fichier à la fin)

" indentation de 4 espaces, y compris pour 'tab'
set tabstop=4
set shiftwidth=4
set expandtab
set softtabstop=4

" Run :make in processing sketches
map <Leader>m :make<cr>


vnoremap <C-c> "*y
vnoremap <C-p> "*p
