 Situação

Você receberá um JSON contendo dados estruturados de uma refeição, incluindo ingredientes, métodos de preparo, perfil nutricional e características sensoriais. Esses dados serão utilizados em um sistema de busca contextual com RAG (Retrieval-Augmented Generation) para fornecer recomendações de harmonização alimentar aos usuários. Diferentes tipos de refeições serão processados, cada uma com perfis sensoriais distintos.

Tarefa

Gere informações de harmonização alimentar para a refeição fornecida. Analise suas características sensoriais (sabor predominante, intensidade, gordura, acidez, doçura, textura, temperatura e aromas) e crie recomendações de alimentos e combinações que complementem ou contrastem adequadamente com ela.

Objetivo

Produzir conteúdo em português brasileiro otimizado para busca semântica em sistemas RAG, permitindo que usuários encontrem sugestões de harmonização relevantes com base nas propriedades sensoriais e estruturais da refeição.

Conhecimento

* Refeições podem apresentar perfis variados: leves, gordurosas, ácidas, doces, salgadas, picantes, umami, crocantes, cremosas, etc.
* Gordura e untuosidade pedem contraste com acidez, amargor leve ou frescor
* Pratos ácidos combinam com alimentos suaves ou levemente doces
* Preparos intensos (grelhados, defumados, fritos) pedem acompanhamentos que equilibrem ou limpem o paladar
* Textura influencia harmonização: crocante vs cremoso, leve vs denso
* Temperatura e método de preparo impactam a percepção sensorial
* Ingredientes principais (proteínas, temperos, molhos) determinam o perfil dominante

Instruções de Saída

Estruture a resposta em texto corrido, organizado nas seguintes seções:

Perfil Sensorial:
Descreva de forma objetiva o perfil da refeição, destacando sabor dominante, intensidade, textura, teor de gordura, acidez e principais aromas.

Harmonizações Principais:
Liste 4 a 5 sugestões de pratos ou acompanhamentos que harmonizam com a refeição. Para cada item, inclua uma justificativa curta (máximo 2 linhas), destacando o contraste ou complementaridade sensorial.

Aperitivos e Entradas:
Sugira 3 a 4 opções leves que preparem o paladar para a refeição.

Queijos Recomendados:
Indique 2 a 3 tipos de queijo compatíveis com o perfil da refeição.

Dicas Práticas:
Forneça 2 a 3 dicas objetivas para melhorar a experiência de harmonização (combinação de sabores, equilíbrio de texturas, temperatura, etc).

Regras de Escrita (IMPORTANTE PARA RAG):

* Use linguagem direta, informativa e sem floreios
* Priorize termos sensoriais e culinários (ex: gorduroso, crocante, ácido, leve, intenso)
* Evite sinônimos desnecessários; mantenha consistência terminológica
* Inclua naturalmente palavras-chave relevantes ao perfil da refeição
* Evite generalizações; todas as recomendações devem se conectar às características específicas da refeição
* Não invente informações ausentes no JSON
