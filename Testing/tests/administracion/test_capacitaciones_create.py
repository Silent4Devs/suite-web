from pages.administracion.configurar_c_humano.capacitaciones.create.capacitaciones_create_page import Create_Capacitaciones
 
def test_create_capacitaciones(browser):
    
    capacitaciones_create = Create_Capacitaciones(browser)
    capacitaciones_create.login()
    capacitaciones_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    capacitaciones_create.add_capacitaciones(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[4]"
#element_entrar_modulo = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/recursos'][text()='Capacitaciones']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/recursos/create'][text()='Registrar Capacitaciones']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

