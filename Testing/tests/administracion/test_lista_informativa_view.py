from pages.administracion.configurar_organizacion.lista_informativa.view.lista_informativa_view_page import Lista_Informativa
 
def test_view_lista_informativa(browser):
    
 view_ListaInformativa = Lista_Informativa(browser)
 view_ListaInformativa()
 view_ListaInformativa.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/lista-informativa'][text()='Lista Informativa']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"


