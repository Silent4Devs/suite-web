from pages.administracion.configurar_organizacion.categoria_de_activos.create.categoria_activos_create_page import Create_Categoria_Activos
 
def test_create_categoria_de_activos(browser):
    
    create_categoria_activos = Create_Categoria_Activos(browser)
    create_categoria_activos.login()
    create_categoria_activos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    create_categoria_activos.add_categoria_activos(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/tipoactivos'][text()='Categorias de Activos']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

