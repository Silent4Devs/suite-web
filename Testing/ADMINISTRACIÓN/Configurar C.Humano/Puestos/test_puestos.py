import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
element_confirgurar_organizacion = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/puestos'][text()='Puestos']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
save_btn_xpath="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"


#Temporizadores
tiempo_modulos = 6
tiempo_carga = 10
tiempo_espera = 2.5

@pytest.fixture
def driver():
    driver = webdriver.Firefox()
    yield driver
    driver.quit()
    

def test_puestos(driver):

    # Abrir la URL de Tabantaj
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usuario = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys("admin@admin.com")
    time.sleep(tiempo_modulos)
    password = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys("#S3cur3P4$$w0Rd!")
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()
    
    # Entrando a Menu Hamburguesa
    print("URL actual:", driver.current_url)
    print("Entrando a Menu Hamburguesa...")
    element = driver.find_element(By.XPATH, menu_hamburguesa)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, menu_hamburguesa)))
    print("Dando clic en Menu Hamburguesa...")
    element.click()
    
    time.sleep(tiempo_modulos)
      
    # Entrando a Modulo Configurar Capital Humano
    print("Entrando a Capital Humano...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic en Capital Humano...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Puestos
    print("Entrando a Sub Modulo Puestos...")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Puestos...")
    entrar.click()
    
    time.sleep(tiempo_modulos)

    # Dando clic en Boton Agregar Glosario
    print("Dando clic al botón Agregar...")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)
    
    ##################################################### AGREGAR Y LLENAR REPOSITORIO ######################################

    # Nombre del Puesto
    campo_puestos = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='puesto']"))
        )
    campo_puestos.click()
    campo_puestos.send_keys("Nombre de Puesto de Prueba 117")

    time.sleep(tiempo_modulos)

    # Area
    campo_area = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_area']"))
        )
    campo_area.click()
    time.sleep(tiempo_espera)
    campo_area.send_keys("Arquitectura")
    time.sleep(tiempo_espera)
    campo_area.click()

    time.sleep(tiempo_modulos)
    
    # Reportará a
    campo_reportara_a = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='reporta_puesto_id']"))
    )
    campo_reportara_a.click()
    time.sleep(tiempo_espera)
    campo_reportara_a.send_keys("Consultor jr")
    time.sleep(tiempo_espera)
    campo_reportara_a.click()

    time.sleep(tiempo_modulos)

    # No. de personas a su cargo Internas
    campo_n_de_personas_internas = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control '])[2]"))
    )
    campo_n_de_personas_internas.click()
    campo_n_de_personas_internas.send_keys("5")

    time.sleep(tiempo_modulos)
    
    # No. de personas a su cargo Externas
    campo_n_de_personas_externas = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control '])[3]"))
    )
    campo_n_de_personas_externas.click()
    campo_n_de_personas_externas.send_keys("5")

    time.sleep(tiempo_modulos)

    # Actividad
    campo_actividad = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='actividad_responsabilidades']"))
    )
    campo_actividad.clear()
    campo_actividad.send_keys("Actividad de Prueba")
   
    time.sleep(tiempo_modulos)

    # Resultado Esperado
    campo_esperado = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='resultado_certificado_responsabilidades']"))
    )
    campo_esperado.clear()
    campo_esperado.send_keys("Resultado esperado de prueba")
 
    time.sleep(tiempo_modulos)

    # Guardar

    guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)
    
    
    #################################BUSCAR REPOSITORIO Y ENTRAR A BOTONES DE EDICION###################################

    # Campo Buscar
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
    )
    campo_entrada.clear()
    campo_entrada.send_keys("Nombre de Puesto de Prueba 117")

    time.sleep(tiempo_carga)

    # Boton 3 puntos
    print("Dando clic al botón 3 puntos...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    puntos_btn = wait.until(EC.presence_of_element_located((By.XPATH, trespuntos_btn_xpath)))
    # Ahora intenta hacer clic en el elemento
    puntos_btn.click()

    time.sleep(tiempo_modulos)

    # Boton editar
    print("Dando clic al botón editar...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    btn_editar = wait.until(EC.presence_of_element_located((By.XPATH, btn2_editar)))
    # Ahora intenta hacer clic en el elemento
    btn_editar.click()

    time.sleep(tiempo_modulos)  
    
    # Ingresar resultado esperado
    resultado_esperado_ingresado = "Resultado esperado de prueba"

    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='resultado_certificado_responsabilidades']"))
    )

    campo_entrada.clear()
    campo_entrada.send_keys(resultado_esperado_ingresado)

    time.sleep(tiempo_modulos)  

    # Guardar actualización
    print("Dando clic al botón Guardar para guardar actualización...")
    guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)  
    
    """
    def test_puestos(browser):
       
    user = "admin@admin.com"
    psw = "#S3cur3P4$$w0Rd!"
    
    test_puestos(browser, user,psw)"""

