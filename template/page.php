{% extends 'layout.php' %}

{% block page_title %}{{title}}{% endblock %}
{% block content %} 

{% autoescape false %} 
  {{ content|raw }}
{% endautoescape %} 

{% endblock %}  