from pages.administrador.ajustes_sg.lista_de_distribucion.edit.lista_de_distribucion_edit_page import Edit_lista_de_distribucion
 
def test_clasificacion_create(browser):
    
 clasifiacion_edit = Edit_lista_de_distribucion(browser)
 clasifiacion_edit.login()
 clasifiacion_edit.in_submodulo(menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo)
 clasifiacion_edit.update_lista_de_distribucion(trespuntos_btn_xpath, boton_editar)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//a[contains(@href, '/admin/lista-distribucion') and normalize-space()='Lista de distribución']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "//A[@href='/admin/lista-distribucion/4/edit']"

