from pages.administracion.configurar_organizacion.glosario.create.glosario_create_page import Create_Glosario
 
def test_create_glosario(browser):
    
    create_glosario = Create_Glosario(browser)
    create_glosario.login()
    create_glosario.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    create_glosario.add_glosario(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/glosarios'][text()='Glosario']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

