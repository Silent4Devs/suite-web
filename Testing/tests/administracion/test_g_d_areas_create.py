from pages.administracion.configurar_organizacion.crear_grupo_de_areas.create.g_d_areas_create_page import Create_G_D_Areas
 
def test_create_g_d_areas(browser):
    
 create_g_d_areas = Create_G_D_Areas(browser)
 create_g_d_areas.login()
 create_g_d_areas.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 create_g_d_areas.add_g_d_areas(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/grupoarea'][text()='Crear Grupo de Áreas']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"


