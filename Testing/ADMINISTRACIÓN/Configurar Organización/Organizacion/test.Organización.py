from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

#Variables
tiempo_modulos = 5
tiempo_carga = 10
tiempo_espera = 2.5
element_xpath0 = "//I[@class='bi bi-buildings']"
element_clausula = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"
clasificacion_xpath="//a[contains(.,'Clasificación')]"
crear_organizacion_btn_xpath= "//a[@href='https://192.168.9.78/admin/organizacions/1/edit' and normalize-space()='Editar Organización']"
panel_de_control = "//a[@class='btn btn-success' and normalize-space()='Panel de Control']"
id_xpath="///input[contains(@type,'number')]"
#save_btn_xpath="//BUTTON[contains(@class, 'btn-danger') and contains(@class, 'float-right') and normalize-space()='Guardar']"
opciones_xpath="(//i[contains(@class,'fa-solid fa-ellipsis-vertical')])[1]"
guardar_xpath="//BUTTON[contains(@class, 'float-right') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"


#Temporizadores
tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5

# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = input("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()

try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    time.sleep(tiempo_modulos)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//font[@class='letra_blanca'][contains(.,'Mi perfil')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

time.sleep(tiempo_modulos)

#Entrando a menu hamburguesa
menu_hambuerguesa=driver.find_element(By.XPATH,"//BUTTON[@class='btn-menu-header']")
menu_hambuerguesa.click()
time.sleep(tiempo_modulos)

time.sleep(tiempo_modulos)

#Modulo Configurar Organizacion
print("Entrando a Configurar Organizacion...")
element = driver.find_element(By.XPATH, element_xpath0)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath0)))
print("Dando clic en Configurar Organizacion...")
element.click()

time.sleep(tiempo_modulos)

#Sub modulo Organizacion
print("Entrando a Sub modulo Organizacion...")
element = driver.find_element(By.XPATH, element_clausula)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_clausula)))
print("Dando clic en Sub modulo Organizacion...")
element.click()

time.sleep(tiempo_modulos)

"""
#Panel de Control
print("Dando clic en boton Panel de Control")
wait = WebDriverWait(driver, 10)
# Esperar a que el elemento esté presente en el DOM
crear_clasificacion_btn = wait.until(EC.presence_of_element_located((By.XPATH, panel_de_control)))
# Ahora intenta hacer clic en el elemento
crear_clasificacion_btn.click()

#Seleccionar btns Panel de Control

btnLogo = driver.find_element(By.XPATH,"(//SPAN[@class='c-switch-slider'])[1]").click()
time.sleep(tiempo_espera)

btnRFC = driver.find_element(By.XPATH,"(//SPAN[@class='c-switch-slider'])[5]").click()

#Regresar pestaña anterior 
driver.back()
"""

#NUEVO APARTADO EDITAR ORGANIZACION

#Editar Organizacion
print("Dando clic al botón Editar Organizacion..")
wait = WebDriverWait(driver, 10)
# Esperar a que el elemento esté presente en el DOM
editar_organizacion_btn = wait.until(EC.presence_of_element_located((By.XPATH, crear_organizacion_btn_xpath)))
# Ahora intenta hacer clic en el elemento
editar_organizacion_btn.click()

time.sleep(tiempo_modulos)

#Campo Correo
def Correo_id(driver):
    # Obtener la entrada del usuario desde la terminal
    correo_ingresado = input("Ingresa nuevo correo electronico: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='correo']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(correo_ingresado)

#Llamando a la función Correo
Correo_id(driver)

time.sleep(tiempo_modulos)


#Campo Giro
def Giro_id(driver):
    # Obtener la entrada del usuario desde la terminal
    giro_ingresado = input("Ingresa nuevo Giro Empresarial: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='giro']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(giro_ingresado)

#Llamado a la funcion Giro
Giro_id(driver)

time.sleep(tiempo_modulos)

#Campo Telefono
def Telefono_id(driver):
    # Obtener la entrada del usuario desde la terminal
    telefono_ingresado = input("Ingresa nuevo Telefono: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='telefono']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(telefono_ingresado)
#Llamando a la función Telefono
Telefono_id(driver)

time.sleep(tiempo_modulos)

#Guardar
print("Dando clic al botón Guardar...")
def realizar_accion_guardar(driver):
    # Opciones
    guardar_xpath = "//BUTTON[contains(@class, 'float-right') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()
#Llamando funcion Guardar
realizar_accion_guardar(driver)


