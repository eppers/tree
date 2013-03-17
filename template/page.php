{% extends 'layout.php' %}

{% block page_title %}{{title}}{% endblock %}
{% block content %} 
{% include 'left-boxes.php' %}
{% autoescape false %} 
  {{ content|raw }}
{% endautoescape %} 

{% endblock %}  